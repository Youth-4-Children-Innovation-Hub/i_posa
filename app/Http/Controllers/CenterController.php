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
        // $districts = District::all();
        $userData = auth()->user();
        $id = $userData->id;

        $query = District::select('districts.id', 'districts.name', 'regions.name AS region', 'users.name AS cordinator')
        ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
        ->leftJoin('users', 'districts.cordinator_id', '=', 'users.id');
          if (auth()->user()->role_id == 1){
             $districts = $query->get();
          }
            else{
         $districts = $query->where('regions.cordinator_id', '=', auth()->user()->id)
        ->get();
            }

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
    'regionCenters' => $regionCenters, 'districtCenters' =>  $districtCenters]);
    }

    public function Create(Request $request)
{
        // dd($request->all());

    // Add more detailed validation
    $request->validate([
        'name' => 'required|string|max:255',
        'district' => 'required|integer|exists:districts,id', 
        'hod' => 'required|integer|exists:users,id', 
        'ownership' => 'required|string|max:255'
    ]);

    try {
        // Add debugging - log the request data
        // \Log::info('Center creation attempt:', $request->all());
        
        $center = new Center();
        $center->name = $request->name;
        $center->district_id = $request->district;
        $center->hod_id = $request->hod;
        $center->Ownership = $request->ownership;
        $center->Funders = $request->funders; // This can be null
        
        // Add debugging - check if save returns true
        $saved = $center->save();
        \Log::info('Save result:', ['saved' => $saved, 'center_id' => $center->id]);
        
        if ($saved) {
            return redirect('centers')->with('sweet_success', 'Center added successfully.');
        } else {
            return redirect()->back()->with('sweet_error', 'Failed to save center.');
        }
        
    } catch (\Exception $e) {
        // Log the full error for debugging
        \Log::error('Center creation failed:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        
        // Return user-friendly error
        return redirect()->back()->with('sweet_error', 'An error occurred while creating the center: ' . $e->getMessage());
    }
}
    public function edit($id)
    {
        $center = Center::find($id);

        return response()->json(
            [
                'status' => 200,
                'center' => $center
            ]
        );
    }

    public function update_center(Request $request)
    { 
        $request->validate([
            'name' => 'required',
            'district' => 'required',
            'hod' => 'required',
            'ownership' => 'required'
        ]);

        try{
            $center = Center::find($request->center_id);

            $center->name = $request->name;
            $center->district_id = $request->district;
            $center->hod_id = $request->hod;
            $center->Ownership = $request->ownership;
            $center->Funders = $request->funders;

            if ($center->save()) {
                return redirect('centers')->with('sweet_success', "{$center->name} Center updated successfully.");
            }
            else {
                return redirect()->back()->with('sweet_error', 'Failed');

            } 
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

    public function delete(Request $request)
    {

        $center = Center::find($request->id);

        if($center->delete()){
            return response()->json(['status' => true, 'message' => "Center {$center->name} deleted successfully."]);
        }
        return response()->json(['status' => false, 'message' => "Failed to delete center {$center->name}."]);
    }

    public function Search()
    {
        $querry = $_GET['search_querry'];

        if ($querry != null) {
        $roleId = DB::table('roles')->where('role', 'head of center')->value('id');
        $hods = User::where('role_id', $roleId)->get();
        $districts = District::all();
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
        return view('centers.centers', ['heads' => $hods, 'districts' => $districts, 'centers' => $centers, 'userData' => $userData, 'userRole' => $userRole]);
        } else {
            return redirect('centers');
        }
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
