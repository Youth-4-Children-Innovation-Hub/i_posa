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

class reportController extends Controller
{
    public function index(){
        $reports = Report::Select('reports.id AS id', 'reports.user_id as id1','reports.created_at as date', 'users.name AS hoc_name', 'centers.name as center_name', 'reports.name as report_name', 'roles.role AS role_name', 'reports.status as status')
                           ->leftJoin('centers', 'centers.hod_id', '=', 'reports.user_id')
                           ->leftJoin('users', 'users.id', '=', 'reports.user_id')
                           ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
                           ->orderBy('reports.created_at', 'DESC')
                           ->get();
        if(auth()->user() !== null){
            auth()->user()->unreadNotifications->markAsRead();
        }                   
        
        
        return view('centers.reportsPage', ['reports' => $reports]);
    }

    public function upload(Request $request){
        $data = new Report();

        $file = $request->file;
        $filename = $file->getClientOriginalName();
        $request->file->move('assets', $filename);
        $data->name=$filename;
        $data->user_id = Auth::user()->id;
        $data->save();
        // $adminUserId = User::whereHas('role', function ($query) {
        //     $query->where('role', 'admin');
        // })->value('id');
        $districtUserId = User::whereHas('role', function ($query) {
            $query->where('role', 'district cordinator');
        })->value('id');
        $district = User::find($districtUserId);
        $district->notify(new ReportUploaded($data));
       
        // $admin = User::find($adminUserId);
        // $admin->notify(new ReportUploaded($data));
        return redirect()->back();
        
    }

    public function download(Request $request, $file){
        return response()->download(public_path('assets/'.$file));
    }

    public function view($id){
        $data = Report::find($id);
        $data->update(['status' => 'opened']);
        return view('centers.view_report', compact('data'));
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

    public function approve(){
        $update = Newrepport::find($request->report_id);
        $update->status = "Approved";
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
            ->where('stage', '=', 'stage 1' )->count();

            $stage2Students = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->where('stage', '=', 'stage 2' )->count();

            $with3rs = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->where('three_rs', '=', 'Yes' )->count();

            $without3rs = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->where('three_rs', '=', 'No' )->count();

            $longTerm = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->where('term', '=', 'Long term' )->count();

            $shortTerm = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->where('term', '=', 'Short term' )->count();

            $allLearners = Student::select('centers.name AS center_name','students.phone_number AS phone_number', 'students.name AS name', 'students.stage AS stage', 'students.parent AS parent')
            ->leftJoin('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->get();

            $club1 = Club::select('clubs.name AS club_name','clubs.Funding_sources AS funding', 'centers.name AS center')
            ->leftJoin('centers', 'clubs.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->get();

            $clubInfo = Club::select('clubs.name AS club_name', 'Registration_status', 'Chairperson', 'Contact', 'Asset', 'Capital', 'QA_Contact', 'centers.name AS center')
            ->leftJoin('centers', 'clubs.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->get();

            $facilitators = Teacher::select('*')
            ->where('created_by', '=', Auth::user()->id)
            ->get();

            $title = "Quarter report";
            $pdf = Pdf::loadView('report.centerReport', ['owner_funder' => $owner_funder, 'title' => $title,
             'malesCount' => $malesCount, 'femalesCount' => $femalesCount, 'learnersCount' => $learnersCount,
             'stage1Students' => $stage1Students, 'stage2Students' => $stage2Students, 'without3rs' => $without3rs,
             'longTerm' => $longTerm, 'shortTerm' => $shortTerm, 'allLearners' => $allLearners, 'club1' => $club1,
              'clubInfo' => $clubInfo, 'facilitators' => $facilitators] );
             return $pdf->download($title);


    }

    
}