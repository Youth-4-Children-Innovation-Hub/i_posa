<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class DistrictController extends Controller
{

    public function GetDistricts(Request $request)
    {
        if (!$request->session()->exists('pagination_number')) {
            $request->session()->put('pagination_number', 3);
        }
        if ($_GET) {

            if (isset($_GET['number'])) {
                $number =  $_GET['number'];
                $request->session()->put('pagination_number', $_GET['number']);
            }
        }
        $userData = Auth::user();
        $districts = District::select('districts.Id', 'districts.name', 'regions.name AS region', 'users.name AS cordinator')
            ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
            ->leftJoin('users', 'districts.cordinator_id', '=', 'users.id')
            ->get();
        
        $regionDistricts = District::select('districts.Id', 'districts.name', 'regions.name AS region', 'users.name AS cordinator')
        ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
        ->leftJoin('users', 'districts.cordinator_id', '=', 'users.id')
        ->where('regions.cordinator_id', '=', auth()->user()->id)
        ->get();    


        $regions = Region::all();
        $district_cordinator_id = Role::select('id')
            ->where('role', 'district cordinator')
            ->first();
        $users = User::where('role_id', 3)
            ->get();
        return view('district.district', [
            'cordinators' => $users,
            'regions' => $regions,
            'districts' => $districts,
            'userData' =>   $userData,
            'regionDistricts' =>  $regionDistricts,
            'paginate' => $request->session()->get('pagination_number')
        ]);
    }

    public function Create(Request $request)
    {
        try {
            $district = new District();
            $district->name = $request->name;
            $district->cordinator_id = $request->cordinator_id;
            $district->region_id = $request->region_id;
            $district->save();
            return redirect('districts')->with('success', 'User added successfully.');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function Search()
    {
        $querry = $_GET['search_querry'];
        if ($querry != null) {
            $userData = auth()->user();
            $districts = District::select('districts.Id', 'districts.name', 'regions.name AS region', 'users.name AS cordinator')
                ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
                ->leftJoin('users', 'districts.cordinator_id', '=', 'users.id')
                ->where('districts.name', 'LIKE', '%' . $querry . '%')
                ->orWhere('regions.name', 'LIKE', '%' . $querry . '%')
                ->orWhere('users.name', 'LIKE', '%' . $querry . '%')
                ->get();
            $regions = Region::all();
            $district_cordinator_id = Role::select('id')
                ->where('role', 'district cordinator')
                ->first();
            $users = User::where('role_id', $district_cordinator_id->id)
                ->get();
            return view('district.district', ['cordinators' => $users, 'userData' => $userData, 'regions' => $regions, 'districts' => $districts]);
        } else {
            return redirect('districts');
        }
    }

    public function updateDistrict(Request $request)
    {
        $district = District::find($request->district_id);
        try {
            $district->name = $request->name;
            $district->region_id = $request->region_id;
            $district->cordinator_id = $request->cordinator_id;

            if($district->save()) {
                return redirect('districts')->with('success', 'Data updated Succesiful');

            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function deleteDistrict(Request $request)
    {
        $del = District::find($request->id);

        if($del->delete()){
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);

    }

    public function editDistrict($id)
    {
        $district = District::find($id);
        return response()->json([
            "status" => 200,
            "district" => $district,
        ]);

    }

    public function regionDistricts($id)
    {
        $districts = District::select('*')->where('region_id', '=', $id)->get();
        return view('district.districtSelect', ['districts' => $districts]);     
    }
}
