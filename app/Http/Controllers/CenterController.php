<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Region;
use App\Models\Center;
use App\Models\District;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class CenterController extends Controller
{
    //
    public function GetCenters(){
        $hods=User::where('role_id', 3)->get();
        $districts=District::all();
        $userData = auth()->user();
        $id = $userData->id;
        $userRole= DB::table('users')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->where('users.id', $id)
                        ->select('roles.role')
                        ->first();
        
        $centers=Center::select('centers.id AS id','centers.name','regions.name AS region','users.name AS hod','districts.name AS district')
                        ->leftJoin('districts','centers.district_id','=','districts.id')
                        ->leftJoin('users','centers.hod_id','=','users.id')
                        ->leftJoin('regions','regions.id','=','districts.region_id')
                        ->orderBy('centers.created_at','DESC')
                        ->paginate(10);
        return view('centers.centers',['heads'=>$hods, 'districts'=>$districts,'centers'=>$centers,'userData'=>$userData,'userRole'=>$userRole]);
    }

    public function Create(Request $request){
        $center=new Center();
        $center->name=$request->name;   
        $center->district_id=$request->district;
        $center->hod_id=$request->hod;
        $center->save();
        return redirect('centers')->with('success', 'User added successfully.');
      
    }
}