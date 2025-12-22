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

        
        $districts = District::select('districts.id', 'districts.name', 'regions.name AS region', 'users.name AS cordinator')
            ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
            ->leftJoin('users', 'districts.cordinator_id', '=', 'users.id')
            ->get();
        
        $regionDistricts = District::select('districts.id', 'districts.name', 'regions.name AS region', 'users.name AS cordinator')
            ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
            ->leftJoin('users', 'districts.cordinator_id', '=', 'users.id')
            // ->where('regions.cordinator_id', '=', auth()->user()->id)
            ->get();

        // ADD modal: Regions dropdown should be sourced from `mikoa`.
        // Requirement:
        // - Admin: only show mikoa names that are NOT yet in `regions`
        // - Region coordinator: show only their assigned region(s)
        $addMikoaQuery = Mikoa::query()
            ->select('mikoa.id as id', 'mikoa.name as name');

        if (auth()->user()->role_id == 1) {
            $addMikoaQuery->whereNotIn('mikoa.name', Region::query()->select('name'));

            // Only include mikoa that have at least one wilaya not already used in districts
            $addMikoaQuery->whereExists(function ($q) {
                $q->select(DB::raw(1))
                    ->from('wilaya')
                    ->whereColumn('wilaya.region_id', 'mikoa.id')
                    ->whereNotIn('wilaya.name', District::query()->select('name'));
            });
        } else {
            $addMikoaQuery
                ->join('regions', 'regions.name', '=', 'mikoa.name')
                ->where('regions.cordinator_id', '=', auth()->user()->id);
        }

        $regions = $addMikoaQuery->get();

        // EDIT modal: allow selecting from already-registered regions only (update-only behavior)
        $editMikoaQuery = Mikoa::query()->select('mikoa.id as id', 'mikoa.name as name');
        if (auth()->user()->role_id == 1) {
            $editMikoaQuery->whereIn('mikoa.name', Region::query()->select('name'));
        } else {
            $editMikoaQuery
                ->join('regions', 'regions.name', '=', 'mikoa.name')
                ->where('regions.cordinator_id', '=', auth()->user()->id);
        }
        $editRegions = $editMikoaQuery->get();

        $district_cordinator_id = Role::select('id')
            ->where('role', 'district cordinator')
            ->first();
        // Add modal: only users who are not assigned as a coordinator in any district
        $assignedCordinatorIds = District::pluck('cordinator_id')->toArray();
        $addCordinators = User::where('role_id', 3)
            ->whereNotIn('id', $assignedCordinatorIds)
            ->get();

        // Edit modal: include all coordinators so the current assignment is selectable.
        // Uniqueness is enforced on updateDistrict.
        $editCordinators = User::where('role_id', 3)->get();
        return view('district.district', [
            'cordinators' => $addCordinators,
            'editCordinators' => $editCordinators,
            'regions' => $regions,
            'editRegions' => $editRegions,
            'districts' => $districts,
            'userData' =>   $userData,
            'regionDistricts' =>  $regionDistricts,
            'paginate' => $request->session()->get('pagination_number')
        ]);
    }

    public function Create(Request $request)
    {
        $request->validate([
            'region' => ['required'],
            'wilaya_id' => ['required'],
            'cordinator_id' => ['required'],
        ]);

        $mkoa = Mikoa::select('id', 'name')->where('id', '=', $request->region)->firstOrFail();
        $wilaya = Wilaya::select('id', 'name', 'region_id')->where('id', '=', $request->wilaya_id)->firstOrFail();

        if ((int) $wilaya->region_id !== (int) $mkoa->id) {
            return redirect()->back()
                ->with('sweet_error', 'Selected district does not belong to the selected region.')
                ->withInput();
        }

        // Ensure a matching Region row exists for this mkoa name.
        // (Needed because districts.region_id references regions.id)
        $region = Region::firstOrCreate(
            ['name' => $mkoa->name],
            ['cordinator_id' => auth()->user()->id]
        );
        try {
            $district = new District();
            $district->name = $wilaya->name;
            $district->cordinator_id = $request->cordinator_id;
            $district->region_id = $region->id;
            $district->save();
            return redirect('districts')->with('sweet_success', 'District added successfully.');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function getRegionDistricts(Request $request, $region_id)
    {
        // `wilaya.region_id` references `mikoa.id`
        // Exclude wilaya names already present in `districts.name`
        $districtId = $request->query('district_id');
        $existingDistrictNames = District::query()
            ->when($districtId, function ($q) use ($districtId) {
                $q->where('id', '!=', $districtId);
            })
            ->pluck('name')
            ->toArray();

        $wilaya = Wilaya::query()
            ->select('id', 'name')
            ->where('region_id', $region_id)
            ->whereNotIn('name', $existingDistrictNames)
            ->orderBy('name')
            ->get();

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
        $request->validate([
            'district_id' => ['required'],
            'region' => ['required'],
            'wilaya_id' => ['required'],
            'cordinator_id' => ['required'],
        ]);

        $district = District::findOrFail($request->district_id);

        // Prevent assigning a coordinator already used by another district
        $cordinatorInUse = District::query()
            ->where('cordinator_id', '=', $request->cordinator_id)
            ->where('id', '!=', $district->id)
            ->exists();
        if ($cordinatorInUse) {
            return redirect()->back()
                ->with('sweet_error', 'Selected coordinator is already assigned to another district.')
                ->withInput();
        }

        $mkoa = Mikoa::select('id', 'name')->where('id', '=', $request->region)->firstOrFail();
        $wilaya = Wilaya::select('id', 'name', 'region_id')->where('id', '=', $request->wilaya_id)->firstOrFail();

        if ((int) $wilaya->region_id !== (int) $mkoa->id) {
            return redirect()->back()
                ->with('sweet_error', 'Selected district does not belong to the selected region.')
                ->withInput();
        }

        // Update-only: do NOT create a new Region row here.
        $region = Region::where('name', '=', $mkoa->name)->first();
        if (!$region) {
            return redirect()->back()
                ->with('sweet_error', 'Selected region is not registered yet. Please add it first.')
                ->withInput();
        }

        try {
            $district->name = $wilaya->name;
            $district->region_id = $region->id;
            $district->cordinator_id = $request->cordinator_id;

            if ($district->save()) {
                return redirect('districts')->with('sweet_success', 'District updated successfully.');
            }

            return redirect()->back()->with('sweet_error', 'Failed to update district.')->withInput();
        } catch (\Throwable $th) {
            \Log::error('District update failed: ' . $th->getMessage());

            return redirect()->back()
                ->with('sweet_error', 'Failed to update district. Please try again.')
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
        $district = District::findOrFail($id);

        $mikoaId = null;
        $wilayaId = null;
        $region = Region::find($district->region_id);
        if ($region) {
            $mkoa = Mikoa::where('name', '=', $region->name)->first();
            if ($mkoa) {
                $mikoaId = $mkoa->id;
                $wilaya = Wilaya::where('region_id', '=', $mkoa->id)
                    ->where('name', '=', $district->name)
                    ->first();
                if ($wilaya) {
                    $wilayaId = $wilaya->id;
                }
            }
        }

        return response()->json([
            "status" => 200,
            "district" => $district,
            "mikoa_id" => $mikoaId,
            "wilaya_id" => $wilayaId,
        ]);

    }

    public function regionDistricts($id)
    {
        $districts = District::select('*')->where('region_id', '=', $id)->get();
        return view('district.districtSelect', ['districts' => $districts]);     
    }
}

