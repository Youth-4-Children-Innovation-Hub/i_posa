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
        // $center_distribution = Region::Select('regions.name as reg_name', 'districts.name as dist_name','centers.name as center_name')
        // ->leftJoin('districts', 'districts.region_id', '=', 'regions.id')
        // ->leftJoin('centers', 'centers.district_id', '=', 'districts.id')
        // ->orderBy('regions.name')
        // ->get();
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
}