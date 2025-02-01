<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\stroage;
use App\Models\Report;
use App\Models\Newrepport;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ReportUploaded;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Region;
use Illuminate\Support\Facades\DB;
use App\Models\Center;
use App\Models\CourseCenter;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Club;
use App\Models\CenterReport;
use App\Models\District;
use App\Models\Inventory;
use App\Models\Remark;
use App\Models\Role;
use App\Models\Challenge;
use Notification;
use App\Notifications\mailNotification;

class reportController extends Controller
{
    public function index(){
        $reports = CenterReport::Select('center_reports.id as id', 'districts.cordinator_id as dist_id', 'center_reports.user_id as id1','center_reports.created_at as date', 'users.name AS hoc_name', 'centers.name as center', 'centers.hod_id as hod_id', 
        'center_reports.name as report_name', 'regions.cordinator_id as reg_id', 'roles.role AS role_name', 'center_reports.dist_approval', 'center_reports.reg_approval', 
        'remarks.remark as remark', 'center_reports.nat_status')
                           ->join('centers', 'centers.hod_id', '=', 'center_reports.user_id')
                           ->join('users', 'users.id', '=', 'center_reports.user_id')
                           ->join('roles', 'roles.id', '=', 'users.role_id')
                           ->join('districts', 'districts.id', '=', 'centers.district_id')
                           ->join('regions', 'regions.id', '=', 'districts.region_id')
                           ->leftJoin('remarks', 'remarks.report_id', '=', 'center_reports.id')
                           ->orderBy('center_reports.created_at', 'DESC')
                           ->get();
        if(auth()->user() !== null){
            auth()->user()->unreadNotifications->markAsRead();
        }                   
        
        
        return view('centers.reportsPage', ['reports' => $reports]);
    }

    public function sendMail(){
        $user = User::find(47);

        $details = [
            'greeting'=>'hi ' .auth()->user()->name,
            'body'=>'This is the email body',
            'actiontext'=>'click',
            'actionurl'=> url('reports_page'),
            'lastline'=>'This is the last line',
        ];

        Notification::send($user, new mailNotification($details));
        dd('done');
    }

    public function createChallenge(Request $request){
        $id = Challenge::select('id')->where('user_id', '=', Auth::user()->id)->first();

        $data = new Challenge();
        $data->introduction = $request->introduction;
        $data->challenges = $request->challenge;
        $data->user_id = Auth::user()->id;

        if($id){
            $data = Challenge::find($id->id);
            $data->introduction = $request->introduction;
            $data->challenges = $request->challenge;
            $data->user_id = Auth::user()->id;
        }

        $data->save();
        return redirect()->back();
             
    }

    public function upload(Request $request){
        $data = new Report();

        $file = $request->file;
        $filename = $file->getClientOriginalName();
        $request->file->move('assets', $filename);
        $data->name=$filename;
        $data->user_id = Auth::user()->id;
        $data->save();
        
        $districtUserId = User::whereHas('role', function ($query) {
            $query->where('role', 'district cordinator');
        })->value('id');
        $district = User::find($districtUserId);
        $district->notify(new ReportUploaded($data));
       
    
        return redirect()->back();
        
    }

    public function download(Request $request, $id){
        $file = centerReport::find($id);
        if( $file->nat_status != 'opened' ){
            $file->nat_status = 'opened';
            $file->save();
        }
        
        $filePath = storage_path('app/public/reports/' . $file->name); 
        return response()->download($filePath);
    }

    public function view($id){
        $data = centerReport::find($id);
        if( $data->nat_status != 'opened' ){
             $data->nat_status = 'opened';
             $data->save();
        }
       
        $filePath = storage_path('app/public/reports/' . $data->name);
        return response()->file($filePath, ['Content-Type' => 'application/pdf']);
   
    }



    public function delete(Request $request)
    {

        $report = Report::find($request->id);

        if($report->delete()){
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }

    public function getNotifications(){
        
        auth()->user()->unreadNotifications->markAsRead();
        return view('users.notifications');
       
    }

    public function send(Request $request){
        $data = new Newrepport();

        $data->Title = $request->title;
        $data->student = $request->students;
        $data->course = $request->courses;
        $data->description = $request->description;
        

        $file = $request->file;
        $filename = $file->getClientOriginalName();
        $request->file->move('assets', $filename);
        $data->attachment=$filename;

        $data->upload_user_id = Auth::user()->id;

        $data->save();
        return redirect()->back();
    }

    public function approve($id){

        $dist_role_id = Role::select('id')->where('role', '=', 'district cordinator')->first();
        $reg_role_id = Role::select('id')->where('role', '=', 'regional cordinator')->first();

        $update = CenterReport::find($id);
        if ( Auth::user()->role_id == $dist_role_id->id ){
            $update->dist_approval = 2;
            $update->save();

            $reg_cord_id = Region::select('regions.cordinator_id')
            ->join('districts', 'districts.region_id', '=', 'regions.id')
            ->where('districts.cordinator_id', '=', Auth::user()->id)->first();
    
            $reg_cord_details = User::find($reg_cord_id->cordinator_id);
    
            $reg_cord_details->notify(new ReportUploaded($update));

            $userToEmail = User::find($reg_cord_id->cordinator_id);

            $districtToEmail = District::select('name')
            ->where('cordinator_id', '=', auth()->user()->id)
            ->first();

            $details = [
                'greeting'=>'hi ' . $reg_cord_details->name,
                'body'=>'You just received a report from ' . Auth::user()->name . ', district coordinator of ' .  $districtToEmail->name . ' . Click the button below to see it.',
                'actiontext'=>'See a report',
                'actionurl'=> url('reports_page'),
                'lastline'=>'This is the last line',
            ];

            Notification::send($userToEmail, new mailNotification($details));
        }

        if ( Auth::user()->role_id == $reg_role_id->id ){
            $update->reg_approval = 2;
            $update->save();

            $nat_cord_id = User::select('users.id as id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->where('roles.role', '=', 'admin')
            ->first();

            $nat_cord_details = User::find($nat_cord_id->id);
            $nat_cord_details->notify(new ReportUploaded($update));
            $userToEmail = User::find($nat_cord_id->id);

            $regionToEmail = Region::select('name')
            ->where('cordinator_id', '=', auth()->user()->id)
            ->first();

            $details = [
                'greeting'=>'hi ' . $nat_cord_details->name,
                'body'=>'You just received a report from ' . Auth::user()->name . ', regional coordinator of ' .  $regionToEmail->name . ' . Click the button below to see it.',
                'actiontext'=>'See a report',
                'actionurl'=> url('reports_page'),
                'lastline'=>'This is the last line',
            ];

            Notification::send($userToEmail, new mailNotification($details));
            

        }
 
        return redirect()->back();
    }

    public function getPdf(){
        
        $center_distribution = Region::select(
            'regions.name as reg_name',
            'districts.name as dist_name',
            'centers.name as center_name',
            DB::raw('(SELECT COUNT(*) FROM centers WHERE centers.district_id = districts.id) as center_count'),
            DB::raw('(SELECT COUNT(*) FROM districts WHERE districts.region_id = regions.id) as district_count'),
            DB::raw('(SELECT COUNT(*) FROM centers WHERE centers.district_id IN (SELECT id FROM districts WHERE districts.region_id = regions.id)) as total_center_count'),
            DB::raw('(SELECT COUNT(*) FROM students WHERE students.center_id = centers.id AND students.gender = "M") as total_male_students'),
            DB::raw('(SELECT COUNT(*) FROM students WHERE students.center_id = centers.id AND students.gender = "F") as total_female_students')
            
        )
            ->leftJoin('districts', 'districts.region_id', '=', 'regions.id')
            ->leftJoin('centers', 'centers.district_id', '=', 'districts.id')
            ->orderBy('regions.name')
            ->get();

            $learners_training = Region::select(
                'regions.name as reg_name',
                'districts.name as dist_name',
                'centers.name as center_name',
                DB::raw('(SELECT COUNT(*) FROM centers WHERE centers.district_id = districts.id) as center_count'),
                DB::raw('(SELECT COUNT(*) FROM students WHERE students.center_id = centers.id) as total_learners'),
                DB::raw('(SELECT COUNT(*) FROM students WHERE students.center_id = centers.id AND students.term = "Long term") as long_term_count'),
                DB::raw('(SELECT COUNT(*) FROM students WHERE students.center_id = centers.id AND students.term = "Short term") as short_term_count'),
                )
                ->leftJoin('districts', 'districts.region_id', '=', 'regions.id')
                ->leftJoin('centers', 'centers.district_id', '=', 'districts.id')
                ->orderBy('regions.name')
                ->get();
        $title = "IPOSA implementation report";
        $pdf = Pdf::loadView('report.reportPdf', ['title' => $title, 'center_distribution' => $center_distribution, 'learners_training' => $learners_training]);
        return $pdf->download($title);
     
    }

    public function centerReport(){
            $owner_funder = Center::select('name', 'Ownership', 'Funders')
            ->where('hod_id', '=', auth()->user()->id)
            ->get();

            $learnersCount = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->count();

            $malesCount = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->where('students.gender', '=', 'M')
            ->count();

            $femalesCount = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->where('students.gender', '=', 'F')
            ->count();

            $stage1Students = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->where('stage', '=', 'Stage one' )->count();

            $stage2Students = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->where('stage', '=', 'Stage two' )->count();

            $with3rs = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->where('stage', '=', 'Stage two' )->count();

            $without3rs = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->where('stage', '=', 'Stage one' )->count();

            $longTerm = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->where('stage', '=', 'Stage one' )->count();

            $shortTerm = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->where('stage', '=', 'Stage two')->count();

            $allLearners = Student::select('centers.name AS center_name','students.phone_number AS phone_number', 'students.name AS name', 'students.stage AS stage',
             'guardians.name AS parent',  'guardians.phone AS gPhone')
            ->leftJoin('centers', 'students.center_id', '=', 'centers.id')
            ->leftJoin('guardians', 'students.id', '=', 'guardians.student_id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->get();

            $club1 = Club::select('clubs.Name AS club_name','clubs.Funding_sources AS funding', 'centers.name AS center')
            ->leftJoin('centers', 'clubs.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->get();

            $clubInfo = Club::select('clubs.Name AS club_name', 'Registration_status', 'Chairperson', 'Contact', 'Asset', 'Capital', 'QA_Contact', 'centers.name AS center')
            ->leftJoin('centers', 'clubs.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->get();

            $facilitators = Teacher::select('*')
            ->where('created_by', '=', Auth::user()->id)
            ->get();

            $challenge = Challenge::select('*')
            ->where('challenges.user_id', '=', Auth::user()->id)
            ->first();

            $inventories = Inventory::select('inventories.*', 'courses.name as course')
            ->distinct()
            ->join('centers', 'centers.id', '=', 'inventories.center_id')
            ->join('courses', 'inventories.course_id', '=', 'courses.id')
            ->where('centers.hod_id', '=', auth()->user()->id)
            ->get();
            
            try {
                $challenge = Challenge::select('*')
                ->where('challenges.user_id', '=', Auth::user()->id)
                ->first();
               
                if ($challenge->introduction === null) {
                    // If introduction is null, inform the user to write it first
                    $errorIntro = "Please write the introduction first.";
                    // You can then display this message to the user or log it
                    return redirect()->back()->with(['errorIntro' => $errorIntro]);
                } 
            } catch (\Throwable $e) {
              
                    $errorIntro = "Write the introduction and challenges first";
                    // You can then display this message to the user or log it
                    return redirect()->back()->with(['errorIntro' => $errorIntro]);
            } 

            $title = "Quarter report";
            $pdf = Pdf::loadView('report.centerReport', ['owner_funder' => $owner_funder, 'title' => $title,
             'malesCount' => $malesCount, 'femalesCount' => $femalesCount, 'learnersCount' => $learnersCount,
             'stage1Students' => $stage1Students, 'stage2Students' => $stage2Students, 'without3rs' => $without3rs,
             'longTerm' => $longTerm, 'shortTerm' => $shortTerm, 'allLearners' => $allLearners, 'club1' => $club1,
              'clubInfo' => $clubInfo, 'facilitators' => $facilitators, 
              'challenge' =>  $challenge, 'inventories' => $inventories ] );
             return $pdf->stream($title);

    }

    public function centerStudents(){

        $center   = Center::select('centers.name AS name')->first();

        $students = Student::select('students.id',
                                    'students.name AS name',
                                    'students.phone_number AS phone',
                                    'students.disability AS disability',
                                    'students.gender',
                                    'students.status')
                                    ->join('centers', 'students.center_id', '=' , 'centers.id')
                                    ->WHERE('centers.hod_id', '=', Auth::user()->id)
                                    ->get();
        
        
        $studentsCount = Student::select('students.id',
                                    'students.name AS name',
                                    'students.phone_number AS phone',
                                    'students.disability AS disability',
                                    'students.gender',
                                    'students.status')
                                    ->join('centers', 'students.center_id', '=' , 'centers.id')
                                    ->WHERE('centers.hod_id', '=', Auth::user()->id)
                                    ->count();
        $maleCount = Student::select('students.id',
                                        'students.name AS name',
                                        'students.phone_number AS phone',
                                        'students.disability AS disability',
                                        'students.gender',
                                        'students.status')
                                        ->join('centers', 'students.center_id', '=' , 'centers.id')
                                        ->WHERE('centers.hod_id', '=', Auth::user()->id) 
                                        ->WHERE('students.gender', '=', 'M')
                                        ->count();                           
        $femaleCount = Student::select('students.id',
                                        'students.name AS name',
                                        'students.phone_number AS phone',
                                        'students.disability AS disability',
                                        'students.gender',
                                        'students.status')
                                        ->join('centers', 'students.center_id', '=' , 'centers.id')
                                        ->WHERE('centers.hod_id', '=', Auth::user()->id) 
                                        ->WHERE('students.gender', '=', 'F')
                                        ->count();                                              
         
        $dropoutCount = Student::select('students.id',
                                        'students.name AS name',
                                        'students.phone_number AS phone',
                                        'students.disability AS disability',
                                        'students.gender',
                                        'students.status')
                                        ->join('centers', 'students.center_id', '=' , 'centers.id')
                                        ->WHERE('centers.hod_id', '=', Auth::user()->id) 
                                        ->WHERE('students.status', '=', 'dropout')
                                        ->count();                           
               
                $pdf = Pdf::loadView('report.centerStudentsPdf',['students' => $students, 'center' => $center,
                                     'studentsCount' => $studentsCount,'maleCount' => $maleCount,'femaleCount' => $femaleCount,
                                     'dropoutCount' => $dropoutCount]);
                // return  $pdf->download('center_students.pdf');                    
                return $pdf->stream('center_students.pdf');
        
        }

        public function centerCourses(){

            $center   = Center::select('centers.name AS name')
                               ->where('centers.hod_id', '=', Auth::user()->id)
                               ->first();
            $courses   = CourseCenter::select('courses.name AS course', 'teachers.name AS teacher','course_centers.id AS id')
                                  ->leftjoin('teachers', 'teachers.id', '=', 'course_centers.teacher_id')
                                  ->leftjoin('courses', 'courses.id', '=', 'course_centers.course_id')
                                  ->leftjoin('centers', 'centers.id', '=', 'course_centers.center_id')
                                  ->where('centers.hod_id', '=', Auth::user()->id)
                                  ->get();

            $courseCount  = CourseCenter::select('courses_center.id AS id') 
                                          ->join('centers', 'centers.id', '=', 'course_centers.center_id')
                                          ->where('centers.hod_id',  '=', Auth::user()->id)
                                          ->count();

               $pdf = Pdf::loadView('report.centerCoursePdf',['center' => $center, 'courses' => $courses,'courseCount' => $courseCount]);
               return $pdf->stream('center_course.pdf');
        }

        public function centerTeachers(){

            $center   = Center::select('centers.name AS name')
                               ->where('centers.hod_id', '=', Auth::user()->id)
                               ->first();
            $teachers   = Teacher::select('teachers.name AS name', 'teachers.phone_number AS phone', 'teachers.email AS email')
                                  ->leftjoin('centers', 'centers.id', '=', 'teachers.center_id')
                                  ->where('centers.hod_id', '=', Auth::user()->id)
                                  ->get();

            $teacherCount  = Teacher::select('teachers.id AS id') 
                                          ->join('centers', 'centers.id', '=', 'teachers.center_id')
                                          ->where('centers.hod_id',  '=', Auth::user()->id)
                                          ->count();

               $pdf = Pdf::loadView('report.centerTeacherPdf',['center' => $center, 'teachers' => $teachers,'teacherCount' => $teacherCount]);
               return $pdf->stream('center_teacher.pdf');

        }

        public function centerClubs(){

            $center   = Center::select('centers.name AS name')
                       ->where('centers.hod_id', '=', Auth::user()->id)
                       ->first();
            $clubs   = Club::select('clubs.Name AS name', 'clubs.Funding_sources AS funding', 'clubs.Registration_status AS status', 'clubs.Chairperson AS chairperson', 'clubs.Contact AS contact')
                      ->leftjoin('centers', 'centers.id', '=', 'clubs.center_id')
                      ->where('centers.hod_id', '=', Auth::user()->id)
                      ->get();

            $clubCount  = Club::select('clubs.id AS id') 
                          ->join('centers', 'centers.id', '=', 'clubs.center_id')
                          ->where('centers.hod_id',  '=', Auth::user()->id)
                          ->count();

               $pdf = Pdf::loadView('report.centerClubsPdf',['center' => $center, 'clubs' => $clubs,'clubCount' => $clubCount]);
               return $pdf->stream('center_club.pdf');

        }

        public function centerInventories(){

            $center   = Center::select('centers.name AS name')
                       ->where('centers.hod_id', '=', Auth::user()->id)
                       ->first();
            $inventories   = Inventory::select('inventories.name AS name', 'inventories.use_status AS use', 'courses.name AS course')
                      ->leftjoin('centers', 'centers.id', '=', 'inventories.center_id')
                      ->leftjoin('courses', 'courses.id', '=', 'inventories.course_id')
                      ->where('centers.hod_id', '=', Auth::user()->id)
                      ->get();

            $inventoryCount  = Inventory::select('inventories.id AS id') 
                          ->join('centers', 'centers.id', '=', 'inventories.center_id')
                          ->where('centers.hod_id',  '=', Auth::user()->id)
                          ->count();

               $pdf = Pdf::loadView('report.centerInventoryPdf',['center' => $center, 'inventories' => $inventories,'inventoryCount' => $inventoryCount]);
               return $pdf->stream('center_inventory.pdf');

        }

        public function districtStudentsReport()
        {
            $userData = Auth::user();
            $district = District::select('districts.*', 'districts.name AS name')
                          ->where('districts.cordinator_id', '=', $userData->id)
                          ->first();
            $districtStudents = Student::select('students.*', 'students.name AS name', 'students.gender AS gender','students.disability','students.status','courses.name AS course2', 'centers.name AS centerName2')
                ->leftJoin('student_courses', 'student_courses.student_id', '=', 'students.id')
                ->leftJoin('centers', 'students.center_id', '=', 'centers.id')
                ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
                ->leftJoin('courses', 'courses.id', '=', 'student_courses.course_id')
                ->where('districts.cordinator_id', '=', $userData->id)
                ->orderby('name')
                ->get();

            $studentsCount = $districtStudents->count();
            $maleCount = $districtStudents->where('gender', 'M')->count();
            $femaleCount = $districtStudents->where('gender', 'F')->count();
            $disabledCount = $districtStudents->where('disability', '!=', null)->count();
            $dropoutCount = $districtStudents->where('status', 'dropout')->count();

            $pdf = Pdf::loadView('report.districtStudentsPdf', [
                'district' => $district,
                'students' => $districtStudents,
                'studentsCount' => $studentsCount,
                'maleCount' => $maleCount,
                'femaleCount' => $femaleCount,
                'disabledCount' => $disabledCount,
                'dropoutCount' => $dropoutCount
            ]);

            return $pdf->stream('district_students.pdf');
        }

        public function districtCentersReport()
        {
            $userData = Auth::user();
            $district = District::select('districts.*', 'districts.name AS name')
                          ->where('districts.cordinator_id', '=', $userData->id)
                          ->first();
            $districtCenters = Center::select('centers.*', 'centers.name AS centerName', 'districts.name AS districtName', 'users.name AS hoc')
                ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
                ->leftJoin('users', 'centers.hod_id', '=', 'users.id')
                ->where('districts.cordinator_id', '=', $userData->id)
                ->get();

            $centersCount = $districtCenters->count();
            $pdf = Pdf::loadView('report.districtCentersPdf', [
                'centers' => $districtCenters,
                'district' => $district,
                'centersCount' => $centersCount
                
            ]);

            return $pdf->stream('district_students.pdf');
            
        }

        public function districtTeachersReport()
        {
            $userData = Auth::user();
            $district = District::select('districts.*', 'districts.name AS name')
                          ->where('districts.cordinator_id', '=', $userData->id)
                          ->first();

            $districtTeachers = Teacher::select('teachers.*', 'teachers.name AS name', 'teachers.phone_number AS phone', 'teachers.email AS email', 'centers.name AS centerName')
                ->leftJoin('centers', 'teachers.center_id', '=', 'centers.id')
                ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
                ->where('districts.cordinator_id', '=', $userData->id)
                ->get();

            $teachersCount = $districtTeachers->count();
            $pdf = Pdf::loadView('report.districtTeachersPdf', [
                'teachers' => $districtTeachers,
                'district' => $district,
                'teachersCount' => $teachersCount
            ]);

            return $pdf->stream('district_teachers.pdf');
        }

        public function districtClubsReport()
        {
            $userData = Auth::user();
            $district = District::select('districts.*', 'districts.name AS name')
                          ->where('districts.cordinator_id', '=', $userData->id)
                          ->first();

            $districtClubs = Club::select('clubs.*', 'clubs.Name AS name','clubs.Chairperson AS chairperson','clubs.contact AS contact','clubs.funding_sources AS sponsor', 'centers.name AS center')
                ->leftJoin('centers', 'clubs.center_id', '=', 'centers.id')
                ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
                ->where('districts.cordinator_id', '=', $userData->id)
                ->get();

            $clubsCount = $districtClubs->count();
            $pdf = Pdf::loadView('report.districtClubsPdf', [
                'clubs' => $districtClubs,
                'district' => $district,
                'clubsCount' => $clubsCount
            ]);

            return $pdf->stream('district_clubs.pdf');
        }

        public function districtInventoryReport()
        {
            $userData = Auth::user();
            $district = District::select('districts.*', 'districts.name AS name')
                          ->where('districts.cordinator_id', '=', $userData->id)
                          ->first();

            $districtInventories = Inventory::select('inventories.*', 'inventories.name AS name', 'courses.name AS course', 'centers.name AS centerName')
                ->leftJoin('courses', 'inventories.course_id', '=', 'courses.id')
                ->leftJoin('centers', 'inventories.center_id', '=', 'centers.id')
                ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
                ->where('districts.cordinator_id', '=', $userData->id)
                ->get();

            $inventoriesCount = $districtInventories->count();
            $pdf = Pdf::loadView('report.districtInventoriesPdf', [
                'inventories' => $districtInventories,
                'district' => $district,
                'inventoriesCount' => $inventoriesCount
            ]);

            return $pdf->stream('district_inventories.pdf');
        }

        public function regionalCentersReport()
        {
            $userData = Auth::user();
            $region = Region::select('regions.*', 'regions.name AS name')
                          ->where('regions.cordinator_id', '=', $userData->id)
                          ->first();

            $regionCenters = Center::select('centers.*', 'centers.name AS center', 'districts.name AS district', 'users.name AS hoc')
                ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
                ->leftJoin('users', 'centers.hod_id', '=', 'users.id')
                ->where('districts.region_id', '=', $region->id)
                ->get();

            $centersCount = $regionCenters->count();
            $pdf = Pdf::loadView('report.regionalCentersPdf', [
                'centers' => $regionCenters,
                'region' => $region,
                'centersCount' => $centersCount
            ]);

            return $pdf->stream('regional_centers.pdf');
        }

        public function regionalStudentsReport()
        {
            $userData = Auth::user();
            $region = Region::select('regions.*', 'regions.name AS name')
                          ->where('regions.cordinator_id', '=', $userData->id)
                          ->first();

            $regionStudents = Student::select('students.*', 'students.name AS name', 'courses.name AS course', 'students.phone_number AS phone','students.gender AS gender', 'students.status AS status','students.center_id AS center','students.district AS district')
                ->leftJoin('student_courses', 'student_courses.student_id', "=", 'students.id')
                ->leftJoin('courses', 'courses.id', '=', 'student_courses.course_id')
                ->leftJoin('centers', 'students.center_id', '=', 'centers.id')
                ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
                ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
                ->where('regions.cordinator_id', '=', $userData->id)
                ->orderby('name')
                ->get();

            $studentsCount = $regionStudents->count();
            $maleCount = $regionStudents->where('gender','M')->count();
            $femaleCount = $regionStudents->where('gender','F')->count();
            $disabledCount = $regionStudents->where('disability','!=', 'None')->count();
            $dropoutCount = $regionStudents->where('status','Dropout')->count();

            $pdf = Pdf::loadView('report.regionalStudentsPdf', [
                'region' => $region,
                'students' => $regionStudents,
                'studentsCount' => $studentsCount,
                'maleCount' => $maleCount,
                'femaleCount' => $femaleCount,
                'disabledCount' => $disabledCount,
                'dropoutCount' => $dropoutCount
            ]);

            return $pdf->stream('regional_students.pdf');
            }

            public function regionalCoursesReport()
            {
                $userData = Auth::user();
                $region = Region::select('regions.*', 'regions.name AS name')
                              ->where('regions.cordinator_id', '=', $userData->id)
                              ->first();
    
                $regionCourses = CourseCenter::select('courses.name AS course', 'teachers.name AS teacher', 'centers.name AS center','districts.name AS district')
                    ->leftJoin('courses', 'course_centers.course_id', '=', 'courses.id')
                    ->leftJoin('teachers', 'course_centers.teacher_id', '=', 'teachers.id')
                    ->leftJoin('centers', 'course_centers.center_id', '=', 'centers.id')
                    ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
                    ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
                    ->where('regions.cordinator_id', '=', $userData->id)
                    ->get();
    
                $coursesCount = $regionCourses->count();
                $pdf = Pdf::loadView('report.regionalCoursesPdf', [
                    'courses' => $regionCourses,
                    'region' => $region,
                    'coursesCount' => $coursesCount
                ]);
    
                return $pdf->stream('regional_courses.pdf');
            }

            public function regionalTeachersReport()
            {
                $userData = Auth::user();
                $region = Region::select('regions.*', 'regions.name AS name')
                              ->where('regions.cordinator_id', '=', $userData->id)
                              ->first();
    
                $regionTeachers = Teacher::select('teachers.*', 'teachers.name AS name', 'teachers.phone_number AS phone', 'teachers.email AS email', 'centers.name AS center','districts.name AS district')
                    ->leftJoin('centers', 'teachers.center_id', '=', 'centers.id')
                    ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
                    ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
                    ->where('regions.cordinator_id', '=', $userData->id)
                    ->get();
    
                $teachersCount = $regionTeachers->count();
                $pdf = Pdf::loadView('report.regionalTeachersPdf', [
                    'teachers' => $regionTeachers,
                    'region' => $region,
                    'teachersCount' => $teachersCount
                ]);
    
                return $pdf->stream('regional_teachers.pdf');

            }

            public function regionalClubsReport()
            {
                $userData = Auth::user();
                $region = Region::select('regions.*', 'regions.name AS name')
                              ->where('regions.cordinator_id', '=', $userData->id)
                              ->first();
    
                $regionClubs = Club::select('clubs.*', 'clubs.Name AS name','clubs.Chairperson AS chairperson','clubs.contact AS contact','clubs.funding_sources AS sponsor', 'centers.name AS center','districts.name AS district')
                    ->leftJoin('centers', 'clubs.center_id', '=', 'centers.id')
                    ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
                    ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
                    ->where('regions.cordinator_id', '=', $userData->id)
                    ->get();
    
                $clubsCount = $regionClubs->count();
                $pdf = Pdf::loadView('report.regionalClubsPdf', [
                    'clubs' => $regionClubs,
                    'region' => $region,
                    'clubsCount' => $clubsCount
                ]);
    
                return $pdf->stream('regional_clubs.pdf');
            }

            public function regionalInventoryReport(){
                $userData = Auth::user();
                $region = Region::select('regions.*', 'regions.name AS name')
                              ->where('regions.cordinator_id', '=', $userData->id)
                              ->first();
    
                $regionInventories = Inventory::select('inventories.*', 'inventories.name AS name', 'courses.name AS course', 'centers.name AS center','districts.name AS district')
                    ->leftJoin('courses', 'inventories.course_id', '=', 'courses.id')
                    ->leftJoin('centers', 'inventories.center_id', '=', 'centers.id')
                    ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
                    ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
                    ->where('regions.cordinator_id', '=', $userData->id)
                    ->get();
    
                $inventoryCount = $regionInventories->count();
                $pdf = Pdf::loadView('report.regionalInventoryPdf', [
                    'inventories' => $regionInventories,
                    'region' => $region,
                    'inventoryCount' => $inventoryCount
                ]);
    
                return $pdf->stream('regional_inventories.pdf');
            }

            public function nationalStudentsReport(){
                
                $nationalStudents =  Student::select('students.*', 'courses.name AS course','gender','disability','status' ,'centers.name AS center', 'districts.name as district','regions.name AS region')
                ->join('student_courses', 'student_courses.student_id', '=', 'students.id') 
                ->join('centers', 'students.center_id', '=', 'centers.id')
                ->join('districts', 'centers.district_id', '=', 'districts.id')
                ->join('regions', 'regions.id', '=', 'districts.region_id')
                ->join('courses', 'courses.id', '=', 'student_courses.course_id') 
                ->get();  

                $studentsCount = $nationalStudents->count();
                $maleCount     = $nationalStudents->where('gender','M')->count();
                $femaleCount   = $nationalStudents->where('gender','F')->count();
                $disabledCount = $nationalStudents->where('disability','!=', 'None')->count();
                $dropoutCount  = $nationalStudents->where('status','Dropout')->count();

                $pdf = Pdf::loadView('report.nationalStudentsPdf', [
                    
                    'students' => $nationalStudents,
                    'studentsCount' => $studentsCount,
                    'maleCount' => $maleCount,
                    'femaleCount' => $femaleCount,
                    'disabledCount' => $disabledCount,
                    'dropoutCount' => $dropoutCount
                ]);
    
                return $pdf->stream('national_students.pdf');
            }

            
            public function nationalCoursesReport(){

                $nationalCourses = CourseCenter::select('courses.name AS course', 'teachers.name AS teacher', 'centers.name AS center','districts.name AS district','regions.name AS region')
                ->leftJoin('courses', 'course_centers.course_id', '=', 'courses.id')
                ->leftJoin('teachers', 'course_centers.teacher_id', '=', 'teachers.id')
                ->leftJoin('centers', 'course_centers.center_id', '=', 'centers.id')
                ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
                ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
                ->get();

                $courseCount = $nationalCourses->count();
                $pdf = Pdf::loadView('report.nationalCoursesPdf',[
                    'courses'      => $nationalCourses,
                    'courseCount' => $courseCount
                ]);

                return $pdf->stream('national_courses.pdf');


            }

            public function nationalTeachersReport(){
                
                $nationalTeachers = Teacher::select('teachers.*', 'teachers.name AS name', 'teachers.phone_number AS phone', 'teachers.email AS email', 'centers.name AS center','districts.name AS district','regions.name AS region')
                    ->leftJoin('centers', 'teachers.center_id', '=', 'centers.id')
                    ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
                    ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
                    ->get();
    
                $teachersCount = $nationalTeachers->count();
                $pdf = Pdf::loadView('report.nationalTeachersPdf', [
                    'teachers' => $nationalTeachers,
                    'teachersCount' => $teachersCount
                ]);
    
                return $pdf->stream('national_teachers.pdf');
            }
           

    public function uploadCenterReport(){
        $owner_funder = Center::select('name', 'Ownership', 'Funders')
        ->where('hod_id', '=', auth()->user()->id)
        ->get();

        $learnersCount = Student::select('id')
        ->join('centers', 'students.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth::user()->id)
        ->count();

        $malesCount = Student::select('id')
        ->join('centers', 'students.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth::user()->id)
        ->where('students.gender', '=', 'M')
        ->count();

        $femalesCount = Student::select('id')
        ->join('centers', 'students.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth::user()->id)
        ->where('students.gender', '=', 'F')
        ->count();

        $stage1Students = Student::select('id')
        ->join('centers', 'students.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth::user()->id)
        ->where('stage', '=', 'Stage one' )->count();

        $stage2Students = Student::select('id')
        ->join('centers', 'students.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth::user()->id)
        ->where('stage', '=', 'Stage two' )->count();

        $with3rs = Student::select('id')
        ->join('centers', 'students.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth::user()->id)
        ->where('stage', '=', 'Stage two' )->count();

        $without3rs = Student::select('id')
        ->join('centers', 'students.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth::user()->id)
        ->where('stage', '=', 'Stage one' )->count();

        $longTerm = Student::select('id')
        ->join('centers', 'students.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth::user()->id)
        ->where('stage', '=', 'Stage one' )->count();

        $shortTerm = Student::select('id')
        ->join('centers', 'students.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth::user()->id)
        ->where('stage', '=', 'Stage two')->count();

        $allLearners = Student::select('centers.name AS center_name','students.phone_number AS phone_number', 'students.name AS name', 'students.stage AS stage',
         'guardians.name AS parent',  'guardians.phone AS gPhone')
        ->leftJoin('centers', 'students.center_id', '=', 'centers.id')
        ->leftJoin('guardians', 'students.id', '=', 'guardians.student_id')
        ->where('centers.hod_id', '=', Auth::user()->id)
        ->get();

        $club1 = Club::select('clubs.Name AS club_name','clubs.Funding_sources AS funding', 'centers.name AS center')
        ->leftJoin('centers', 'clubs.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth::user()->id)
        ->get();

        $clubInfo = Club::select('clubs.Name AS club_name', 'Registration_status', 'Chairperson', 'Contact', 'Asset', 'Capital', 'QA_Contact', 'centers.name AS center')
        ->leftJoin('centers', 'clubs.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth::user()->id)
        ->get();

        $facilitators = Teacher::select('*')
        ->where('created_by', '=', Auth::user()->id)
        ->get();

        $challenge = Challenge::select('*')
        ->where('challenges.user_id', '=', Auth::user()->id)
        ->get();

        $inventories = Inventory::select('inventories.*', 'courses.name as course')
        ->join('centers', 'centers.id', '=', 'inventories.center_id')
        ->join('courses', 'inventories.course_id', '=', 'courses.id')
        ->where('centers.hod_id', '=', auth()->user()->id)
        ->get();
        try {
            $challenge = Challenge::select('*')
            ->where('challenges.user_id', '=', Auth::user()->id)
            ->first();
           
            if ($challenge->introduction === null) {
                // If introduction is null, inform the user to write it first
                $errorIntro = "Please write the introduction first.";
                // You can then display this message to the user or log it
                return redirect()->back()->with(['errorIntro' => $errorIntro]);
            } 
        } catch (\Throwable $e) {
          
                $errorIntro = "Write the introduction and challenges first";
                // You can then display this message to the user or log it
                return redirect()->back()->with(['errorIntro' => $errorIntro]);
        }
        

        $title = "Quarter report";
        $pdf = Pdf::loadView('report.centerReport', ['owner_funder' => $owner_funder, 'title' => $title,
         'malesCount' => $malesCount, 'femalesCount' => $femalesCount, 'learnersCount' => $learnersCount,
         'stage1Students' => $stage1Students, 'stage2Students' => $stage2Students, 'without3rs' => $without3rs,
         'longTerm' => $longTerm, 'shortTerm' => $shortTerm, 'allLearners' => $allLearners, 'club1' => $club1,
          'clubInfo' => $clubInfo, 'facilitators' => $facilitators, 'challenge' => $challenge, 'inventories' => $inventories] );

        $filename = 'Quarter_report_' . time() . '.pdf';
        $directory = storage_path('app/public/reports');
          if(!File::exists($directory)){
            File::makeDirectory($directory, 0755,true);
          }
        //   dd($directory);
        $pdf->save($directory .'/' . $filename);
        $uploader = User::select('name')->where('id', '=', Auth()->user()->id)->first();

        $createdReport = new CenterReport();
        $createdReport->name = $filename;
        $createdReport->uploaded_by = $uploader->name;
        $createdReport->user_id = Auth()->user()->id;
        $createdReport->save();

        $dist_cord_id = District::select('districts.cordinator_id')
        ->leftJoin('centers', 'districts.id', '=', 'centers.district_id')
        ->where('centers.hod_id', '=', Auth::user()->id)->first();

        $reg_cord_id = Region::select('regions.cordinator_id')
        ->leftjoin('districts', 'districts.region_id', '=', 'regions.id')
        ->leftJoin('centers', 'districts.id', '=', 'centers.district_id')
        ->where('centers.hod_id', '=', Auth::user()->id)->first();

        $dist_cord_details = User::find($dist_cord_id->cordinator_id);
       
        $dist_cord_details->notify(new ReportUploaded($createdReport));

        $userToEmail = User::find($dist_cord_details);

        $centerToEmail = Center::select('name', 'Ownership', 'Funders')
        ->where('hod_id', '=', auth()->user()->id)
        ->first();

        $details = [
            'greeting'=>'hi ' . $dist_cord_details->name,
            'body'=>'You just received a report from ' . Auth::user()->name . ', head of ' .  $centerToEmail->name . ' center. Click the button below to see it.',
            'actiontext'=>'See a report',
            'actionurl'=> url('reports_page'),
            'lastline'=>'This is the last line',
        ];

        Notification::send($userToEmail, new mailNotification($details));
       
        return redirect()->back();

}
        public function addRemarks(Request $request){
            $dist_role_id = Role::select('id')->where('role', '=', 'district cordinator')->first();
            $reg_role_id = Role::select('id')->where('role', '=', 'regional cordinator')->first();

            $data = new Remark();
            $data->remark = $request->remarks;
            $data->report_id = $request->id;
            $data->sent_by = auth()->user()->id;
            $data->save();
            $update = CenterReport::find($request->id);

            if ( Auth::user()->role_id == $dist_role_id->id ){
                $update->dist_approval = 3;
                $update->save();

                $hoc_id = CenterReport::select('user_id')
                ->where('id', '=', $request->id)->first();
                $id_of_center = $hoc_id->user_id;
                

                $hoc_details = User::find($id_of_center);


                $district_details = District::select('districts.name as dist_name')
                ->join('centers', 'centers.district_id', '=', 'districts.id')
                ->join('users', 'centers.hod_id', '=', 'users.id')
                ->where('centers.hod_id', '=',   $id_of_center)
                ->where('districts.cordinator_id', '=',  Auth::user()->id)->first();

          
                $name_of_dist = $district_details->dist_name;

              
                $details = [
                    'greeting'=>'hi ' . $hoc_details->name,
                    'body'=>'You received a feedback from ' . Auth::user()->name . ', district coordinator of ' .  $name_of_dist . ', saying: $request->remarks.',
                    'actiontext'=>'See a report',
                    'actionurl'=> url('reports_page'),
                    'lastline'=>'This is the last line',
                ];

                Notification::send($hoc_details, new mailNotification($details));
            }

            if ( Auth::user()->role_id == $reg_role_id->id ){
                $update->reg_approval = 3;
                $update->save();
                //head of center details
                $hoc_id = CenterReport::select('user_id')
                ->where('id', '=', $request->id)->first();
                $hoc_details = User::find($hoc_id->user_id);

                 //district coordinator details
                 $dist_cordinator_id = District::select('districts.id as id', 'regions.name as reg_name')
                 ->join('centers', 'centers.district_id', '=', 'districts.id')
                 ->join('regions', 'regions.id', '=', 'districts.region_id')
                 ->where('centers.hod_id', '=', $hoc_id->user_id)->first();

                 $dist_email_details = User::find($dist_cordinator_id->id);

                 //email the head of center
                 $details = [
                    'greeting'=>'hi ' . $hoc_details->name,
                    'body'=>'You received a feedback from ' . Auth::user()->name . ', regional coordinator of ' .  $dist_cordinator_id->reg_name . ', saying: $request->remarks.',
                    'actiontext'=>'See a report',
                    'actionurl'=>url('reports_page'),
                    'lastline'=>'This is the last line',
                ];

                Notification::send($hoc_details, new mailNotification($details));

                //email the district coordinator

                $dist_details = [
                    'greeting'=>'hi ' . $dist_email_details->name,
                    'body'=>'You received a feedback from ' . Auth::user()->name . ', regional coordinator of ' .  $dist_cordinator_id->reg_name . ', saying: $request->remarks.',
                    'actiontext'=>'See a report',
                    'actionurl'=> url('reports_page'),
                    'lastline'=>'This is the last line',
                ];

                Notification::send($dist_email_details, new mailNotification($dist_details));

            }
            
            return redirect()->back();
        }

        public function erase($id)
        {
            $report = CenterReport::find($id);
            $roleId = Role::select('id')->where('role', 'head of center')->value('id');
            if (Auth::user()->role_id == $roleId){
                $remark = Remark::where('report_id', $report->id);
                $remark->delete();
                $report->delete();
            }else{
                $report->delete();
            }
           
            return redirect()->back()->with('success', 'Report deleted successfully');
        }
    

    
}