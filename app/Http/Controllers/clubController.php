<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Center;
use Illuminate\Support\Facades\DB;

class clubController extends Controller
{
    public function getClubs(){
        $clubs=Club::all();
        return view('clubs.club', ['clubs' => $clubs]);
    }

    public function createClubs(Request $request){
        $centerId = Center::where('hod_id', '=', Auth()->user()->id)->value('id');
        $club=New Club();
        $club->Name = $request->name;
        $club->Funding_sources = $request->funding;
        $club->Registration_status = $request->registration;
        $club->Chairperson = $request->chairName;
        $club->Contact = $request->contact;
        $club->Email = $request->email;
        $club->Asset = $request->assets;
        $club->Capital = $request->capital;
        $club->QA_contact = $request->QA;
        $club->Center_id = $centerId;
        $club->save();
        return redirect()->back();
    }

    public function clubDetails(Request $request, $id){
        $club_details = DB::table('clubs')
        ->where('id', '=', $id)
        ->select('*')
        ->first();
        return view('clubs.clubDetails', ['club_details' => $club_details]);
    }
}
