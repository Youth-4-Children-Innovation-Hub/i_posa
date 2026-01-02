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
    public function GetCenters()
    {   
        $roleId = DB::table('roles')->where('role', 'head of center')->value('id');
        $hods = User::where('role_id', $roleId)->get();
        $districts = District::all();
        $regions = Region::orderBy('name')->get();
        $userData = auth()->user();
        $id = $userData->id;
        $userRole = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', $id)
            ->select('roles.role')
            ->first();

        $centers = Center::select('centers.*', 'centers.id AS id', 'centers.name', 'regions.name AS region', 'users.name AS hod', 'districts.name AS district')
            ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
            ->leftJoin('users', 'centers.hod_id', '=', 'users.id')
            ->leftJoin('regions', 'regions.id', '=', 'districts.region_id')
            ->orderBy('centers.created_at', 'DESC')
            ->get();
        
        $districtCenters = Center::select('centers.id AS id', 'centers.name', 'users.name AS hod', 'districts.name AS district')
        ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
        ->leftJoin('users', 'centers.hod_id', '=', 'users.id')
        ->where('districts.cordinator_id', '=', auth()->user()->id)
        ->orderBy('centers.created_at', 'DESC')
        ->get();

        $regionCenters = Center::select('centers.id AS id', 'centers.name', 'regions.name AS region', 'users.name AS hod', 'districts.name AS district')
        ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
        ->leftJoin('users', 'centers.hod_id', '=', 'users.id')
        ->leftJoin('regions', 'regions.id', '=', 'districts.region_id')
        ->where('regions.cordinator_id', '=', auth()->user()->id)
        ->orderBy('centers.created_at', 'DESC')
        ->get();
        return view('centers.centers', ['heads' => $hods, 'districts' => $districts, 'centers' => $centers, 'userData' => $userData, 'userRole' => $userRole, 
    'regionCenters' => $regionCenters, 'districtCenters' =>  $districtCenters, 'regions' => $regions]);
    }

    public function Create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'region' => 'required|exists:regions,id',
            'district' => 'required',
            'hod' => 'required',
            'ownership' => 'required'
        ]);

        if (!District::where('id', $request->district)->where('region_id', $request->region)->exists()) {
            return redirect()->back()->withErrors(['district' => 'Selected district does not belong to the chosen region.'])->withInput();
        }

        try{
            $center = new Center();
            $center->name = $request->name;
            $center->district_id = $request->district;
            $center->hod_id = $request->hod;
            $center->Ownership = $request->ownership;
            $center->Funders = $request->funders;
            $center->save();
            return redirect('centers')->with('success', 'User added successfully.');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

    public function edit($id)
    {
        $center = Center::select('centers.*', 'districts.region_id as region_id')
            ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
            ->where('centers.id', $id)
            ->first();

        if (!$center) {
            return response()->json(['status' => 404]);
        }

        return response()->json([
            'status' => 200,
            'center' => $center
        ]);
    }

    public function update_center(Request $request)
    { 
        $request->validate([
            'name' => 'required',
            'region' => 'required|exists:regions,id',
            'district' => 'required',
            'hod' => 'required',
            'ownership' => 'required'
        ]);

        if (!District::where('id', $request->district)->where('region_id', $request->region)->exists()) {
            return redirect()->back()->withErrors(['district' => 'Selected district does not belong to the chosen region.'])->withInput();
        }

        try{
            $center = Center::find($request->center_id);

            $center->name = $request->name;
            $center->district_id = $request->district;
            $center->hod_id = $request->hod;
            $center->Ownership = $request->ownership;
            $center->Funders = $request->funders;

            if ($center->save()) {
                return redirect('centers')->with('success', 'Center added successfully.');
            }
            else {
                return redirect()->back()->with('error', 'Failed');

            } 
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

    public function delete(Request $request)
    {

        $center = Center::find($request->id);

        if($center->delete()){
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }

    public function Search()
    {
        $querry = $_GET['search_querry'];

        if ($querry != null) {
        $roleId = DB::table('roles')->where('role', 'head of center')->value('id');
        $hods = User::where('role_id', $roleId)->get();
        $districts = District::all();
        $regions = Region::orderBy('name')->get();
        $userData = auth()->user();
        $id = $userData->id;
        $userRole = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', $id)
            ->select('roles.role')
            ->first();

        $centers = Center::select('centers.id AS id', 'centers.name', 'regions.name AS region', 'users.name AS hod', 'districts.name AS district')
            ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
            ->leftJoin('users', 'centers.hod_id', '=', 'users.id')
            ->leftJoin('regions', 'regions.id', '=', 'districts.region_id')
            ->where('centers.name', 'LIKE', '%' . $querry . '%')
            ->orWhere('regions.name', 'LIKE', '%' . $querry . '%')
            ->orWhere('users.name', 'LIKE', '%' . $querry . '%')
            ->orWhere('districts.name', 'LIKE', '%' . $querry . '%')
            ->orderBy('centers.created_at', 'DESC')
            ->paginate(10);
        return view('centers.centers', ['heads' => $hods, 'districts' => $districts, 'centers' => $centers, 'userData' => $userData, 'userRole' => $userRole, 'regions' => $regions]);
        } else {
            return redirect('centers');
        }
    }

    public function districtsByRegion($regionId)
    {
        $districts = District::select('id', 'name')
            ->where('region_id', $regionId)
            ->orderBy('name')
            ->get();

        return response()->json($districts);
    }

    public function districtCenters($id)
    {
        $centers = Center::select('*')->where('district_id', '=', $id)->get();
        return view('centers.centerSelect', ['centers' => $centers]);     
    }

    public function centerDetails($id)
    {
        return view('centers.centerDetails', ['id' => $id]);  
    }
}
