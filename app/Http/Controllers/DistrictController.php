<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use App\Models\Wilaya;
use App\Models\Mikoa;
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
        
        // Debug information
        \Log::info('User ID: ' . auth()->user()->id);
        
        $districts = District::select('districts.id', 'districts.name', 'regions.name AS region', 'users.name AS cordinator')
            ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
            ->leftJoin('users', 'districts.cordinator_id', '=', 'users.id')
            ->get();
        
        $regionDistricts = District::select('districts.id', 'districts.name', 'regions.name AS region', 'users.name AS cordinator')
            ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
            ->leftJoin('users', 'districts.cordinator_id', '=', 'users.id')
            // ->where('regions.cordinator_id', '=', auth()->user()->id)
            ->get();
            
        // Debug information
        \Log::info('Region Districts Count: ' . $regionDistricts->count());
        \Log::info('Region Districts: ' . $regionDistricts->toJson());

         $query = Region::select('regions.name as name', 'mikoa.id as id')
        ->join('mikoa', 'mikoa.name', '=', 'regions.name')
        ->leftJoin('users', 'regions.cordinator_id', '=', 'users.id');

          if(auth()->user()->role_id == 1){
            $regions = $query->get();
          }
          else{
              $regions =$query->where('regions.cordinator_id', '=', auth()->user()->id)
              ->get();
            }

        $district_cordinator_id = Role::select('id')
            ->where('role', 'district cordinator')
            ->first();
        // Only users who are not assigned as a cordinator in any district
        $assignedCordinatorIds = District::pluck('cordinator_id')->toArray();
        $users = User::where('role_id', 3)
            ->whereNotIn('id', $assignedCordinatorIds)
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
        $mkoa = Mikoa::select('name')->where('id', '=', $request->region)->first();  
        $region_id = Region::select('regions.id as id')->where('name', '=', $mkoa->name)->first();
        try {
            $district = new District();
            $district->name = $request->name;
            $district->cordinator_id = $request->cordinator_id;
            $district->region_id = $region_id->id;
            $district->save();
            return redirect('districts')->with('swweet_success', 'User added successfully.');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function getRegionDistricts($region_id)
    {
        $wilaya = Wilaya::where('region_id', $region_id)->get();
        return response()->json($wilaya);
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
            // Log the error for debugging
        \Log::error('Course creation failed: ' . $th->getMessage());
        
        return redirect()->back()
            ->with('sweet_error', 'Failed to update center course. Please try again.')
            ->withInput();
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

