<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Region;
use App\Models\Center;
use DB;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    //
    public function GetCenters(){
        $hods=User::where('role_id', 3)->get();
        $regions=Region::all();
        $userData = auth()->user();
        $id = $userData->id;
        $userRole= DB::table('users')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->where('users.id', $id)
                        ->select('roles.role')
                        ->first();
        
        $centers=Center::select('centers.id AS id','centers.name','centers.created_at','regions.name AS regions','users.name AS hod')
                        ->leftJoin('regions','centers.region_id','=','regions.id')
                        ->leftJoin('users','centers.hod_id','=','users.id')
                        ->paginate(10);
        return view('centers.centers',['heads'=>$hods, 'regions'=>$regions,'centers'=>$centers,'userData'=>$userData,'userRole'=>$userRole]);
    }

    public function Create(Request $request){
        $center=new Center();
        $center->name=$request->name;   
        $center->region_id=$request->region;
        $center->hod_id=$request->hod;
        $center->save();
        return redirect('centers')->with('success', 'User added successfully.');
      
    }
}