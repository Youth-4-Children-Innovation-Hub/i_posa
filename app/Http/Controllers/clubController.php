<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Center;
use App\Models\Student;
use App\Models\Member;
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

        $adminClubs=Club::select('clubs.*', 'centers.name as cName', 'districts.name as dName', 'regions.name as rName')
        ->join('centers', 'centers.id', '=', 'clubs.Center_id')
        ->join('districts', 'districts.id', '=', 'centers.district_id')
        ->join('regions', 'regions.id', '=', 'districts.region_id')
        ->get();

        $students = Student::select('students.*')
        ->Join('centers', 'students.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth()->user()->id)
        ->get();

      
        return view('clubs.club', ['clubs' => $clubs, 'distclubs' => $distclubs, 'regclubs' => $regclubs, 'adminClubs' =>  $adminClubs, 
        'students' => $students ]);
    }

    public function createClubs(Request $request){
        $centerId = Center::where('hod_id', '=', Auth()->user()->id)->value('id');
        
        $student = Student::select('students.*')->where('students.id', '=', $request->chairId)->first();
        $club=New Club();
        $club->Name = $request->name;
        $club->Funding_sources = $request->funding;
        $club->Registration_status = $request->registration;
        $club->Chairperson = $student->name;
        $club->Contact = $student->phone_number;
        $club->Email = $student->email;
        $club->Asset = $request->assets;
        $club->Capital = $request->capital;
        $club->QA_contact = $request->QA;
        $club->Center_id = $centerId;
        $club->save();

        $member = new Member();
        $member->student_id = $student->id;
        $member->club_id = $club->id;
        $member->save();

        return redirect()->back();
    }

    public function editClubs(Request $request){
       
        $centerId = Center::where('hod_id', '=', Auth()->user()->id)->value('id');
        $student = Student::select('students.*')->where('students.id', '=', $request->chairId)->first();
        
        $club = Club::find($request->club_id);
        $club->Name = $request->name;
        $club->Funding_sources = $request->funding;
        $club->Registration_status = $request->registration;
        $club->Chairperson = $student->name;
        $club->Contact = $student->phone_number;
        $club->Email = $student->email;
        $club->Asset = $request->assets;
        $club->Capital = $request->capital;
        $club->QA_contact = $request->QA;
        $club->Center_id = $centerId;
        $club->save();
        return redirect()->back();
    }

    public function getMembers($id){
        $club = Club::find($id);

        $students = Student::select('students.*')
        ->Join('centers', 'students.center_id', '=', 'centers.id')
        ->Join('members', 'members.student_id', '=', 'students.id')
        ->where('centers.hod_id', '=', Auth()->user()->id)
        ->where('members.club_id', '=', $club->id)
        ->get();

        $members = Student::select('students.*')
        ->Join('centers', 'students.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth()->user()->id)
        ->whereNotIn('students.id', function($query) {
            $query->select('student_id')->from('members');
        })
        ->get();
        return view('clubs.members', ['club' => $club, 'members' => $members, 'students' => $students]);
    }

    public function addMembers(Request $request){
        try{
            for ($i = 0; $i < sizeof($request->member_id); $i++) {
                $member = new Member();
                $member->student_id = $request->member_id[$i];
                $member->club_id = $request->club_id;
                $member->save();
                
            }
            return redirect()->back()->with('success', 'Member added successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
        
    }

    public function clubDetails(Request $request, $id){
        
        $club_details = DB::table('clubs')
        ->where('id', '=', $id)
        ->select('*')
        ->first();

        $students = Student::select('students.*')
        ->Join('centers', 'students.center_id', '=', 'centers.id')
        ->Join('members', 'members.student_id', '=', 'students.id')
        ->where('centers.hod_id', '=', Auth()->user()->id)
        ->where('members.club_id', '=', $club_details->id)
        ->get();

        return view('clubs.clubDetails', ['club_details' => $club_details, 'students' => $students]);
    }

    public function nationalClubs($id){
        $clubs = Club::select('clubs.Name as name', 'clubs.id as cid')
        ->join('centers', 'centers.id', '=', 'clubs.Center_id')
        ->where('centers.id', '=', $id)->get();
        return view('clubs.nationalClub', ['clubs' => $clubs]);
    }

    public function delete($id)
    {
        $club = Club::find($id);
        $club->delete();

        $clubsData = $this->getClubs();
        
        $clubs = $clubsData['clubs'];
        $distclubs = $clubsData['distclubs'];
        $regclubs = $clubsData['regclubs'];
        $adminClubs = $clubsData['adminClubs'];
        $students = $clubsData['students'];

        return view('clubs.club', ['clubs' => $clubs, 'distclubs' => $distclubs, 'regclubs' => $regclubs, 'adminClubs' =>  $adminClubs, 
        'students' => $students ]);
    }
}
