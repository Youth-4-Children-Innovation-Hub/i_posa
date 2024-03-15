<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Center;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class clubController extends Controller
{
    public function getClubs(){
        $cid = Center::where('hod_id', '=', Auth()->user()->id)->value('id');
        $clubs=Club::all()->where('Center_id', '=', $cid);

        $distclubs=Club::select('clubs.*')
        ->join('centers', 'centers.id', '=', 'clubs.Center_id')
        ->join('districts', 'districts.id', '=', 'centers.district_id')
        ->where('districts.cordinator_id', '=', Auth::user()->id)
        ->get();

        $regclubs=Club::select('clubs.*')
        ->join('centers', 'centers.id', '=', 'clubs.Center_id')
        ->join('districts', 'districts.id', '=', 'centers.district_id')
        ->join('regions', 'regions.id', '=', 'districts.region_id')
        ->where('regions.cordinator_id', '=', Auth::user()->id)
        ->get();

      
        return view('clubs.club', ['clubs' => $clubs, 'distclubs' => $distclubs, 'regclubs' => $regclubs ]);
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

    public function nationalClubs($id){
        $clubs = Club::select('clubs.Name as name', 'clubs.id as cid')
        ->join('centers', 'centers.id', '=', 'clubs.Center_id')
        ->where('centers.id', '=', $id)->get();
        return view('clubs.nationalClub', ['clubs' => $clubs]);
    }
}
