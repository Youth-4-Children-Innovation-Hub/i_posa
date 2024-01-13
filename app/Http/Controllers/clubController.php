<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Center;

class clubController extends Controller
{
    public function getClubs(){
        return view('clubs.club');
    }

    public function createClubs(Request $request){
        $centerId = Center::select('id')
        ->where('hod_id', '=', Auth()->user()->id);

        $club=New Club();
        $club->Name = $request->name;
        $club->Funding_sources = $request->funding;
        $club->Registration_status = $request->registration;
        $club->Chairperson = $request->chairName;
        $club->Contact = $request->phoneNumber;
        $club->Asset = $request->input('multiInput', []);
        $club->Capital = $request->capital;
        $club->QA_contact = $request->QA;
        $club->Center_id = $centerId;
        $club->save();
    }
}
