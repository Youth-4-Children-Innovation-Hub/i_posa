<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Region;
use App\Models\Center;

use Illuminate\Http\Request;

class CenterController extends Controller
{
    //
    public function GetCenters(){
        $hods=User::where('role_id', 3)->get();
        $regions=Region::all();

        $centers=Center::select('centers.id AS id','centers.name','centers.created_at','regions.name AS regions','users.name AS hod')
                        ->leftJoin('regions','centers.region_id','=','regions.id')
                        ->leftJoin('users','centers.hod_id','=','users.id')
                        ->get();

        return view('centers.centers',['heads'=>$hods, 'regions'=>$regions,'centers'=>$centers]);
   
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