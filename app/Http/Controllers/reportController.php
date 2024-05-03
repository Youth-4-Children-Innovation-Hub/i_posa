<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'actiontext'=>'subscribe',
            'actionurl'=>'http://127.0.0.1:8000/reports_page',
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

    public function download(Request $request, $file){
        return response()->download(public_path('assets/'.$file));
    }

    public function view($id){
        $data = centerReport::find($id);
        $data->nat_status = 'opened';
        $data->save();
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
                'actionurl'=>'http://127.0.0.1:8000/reports_page',
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
                'actionurl'=>'http://127.0.0.1:8000/reports_page',
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
        $pdf->save(storage_path('app/public/reports/' . $filename));
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
            'actionurl'=>'http://127.0.0.1:8000/reports_page',
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
                    'actionurl'=>'http://127.0.0.1:8000/reports_page',
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
                    'actionurl'=>'http://127.0.0.1:8000/reports_page',
                    'lastline'=>'This is the last line',
                ];

                Notification::send($hoc_details, new mailNotification($details));

                //email the district coordinator

                $dist_details = [
                    'greeting'=>'hi ' . $dist_email_details->name,
                    'body'=>'You received a feedback from ' . Auth::user()->name . ', regional coordinator of ' .  $dist_cordinator_id->reg_name . ', saying: $request->remarks.',
                    'actiontext'=>'See a report',
                    'actionurl'=>'http://127.0.0.1:8000/reports_page',
                    'lastline'=>'This is the last line',
                ];

                Notification::send($dist_email_details, new mailNotification($dist_details));

            }
            
            return redirect()->back();
        }

        public function erase($id)
        {
            $report = CenterReport::find($id);
            $report->delete();
            return redirect()->back()->with('success', 'Report deleted successfully');
        }
    

    
}