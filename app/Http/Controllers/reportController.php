<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\stroage;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ReportUploaded;
use App\Models\User;

class reportController extends Controller
{
    public function index(){
        $reports = Report::Select('reports.id AS id', 'reports.user_id as id1','reports.created_at as date', 'users.name AS hoc_name', 'centers.name as center_name', 'reports.name as report_name', 'roles.role AS role_name')
                           ->leftJoin('centers', 'centers.hod_id', '=', 'reports.user_id')
                           ->leftJoin('users', 'users.id', '=', 'reports.user_id')
                           ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
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
        //the 2 below should be changed:
        $admin = User::find(2);
        $admin->notify(new ReportUploaded($data));
        return redirect()->back();
        
    }

    public function download(Request $request, $file){
        return response()->download(public_path('assets/'.$file));
    }

    public function view($id){
        $data = Report::find($id);
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
}