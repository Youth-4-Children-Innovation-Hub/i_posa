<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Region;
use App\Models\Mikoa;
use Exception;
use Illuminate\Support\Facades\DB;



class RegionsController extends Controller
{
    public function GetRegions(Request $request)
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

        $userData = auth()->user();
        $id = $userData->id;
        $userRole = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', $id)
            ->select('roles.role')
            ->first();
        // Only users who are not assigned as a cordinator in any region
        $assignedCordinatorIds = Region::pluck('cordinator_id')->toArray();
        $cordinatorsCreate = User::where('role_id', 2)
            ->whereNotIn('id', $assignedCordinatorIds)
            ->get();
        $usedRegionNames = Region::pluck('name')->filter()->toArray();
        $mikoa = Mikoa::query()
            ->when(count($usedRegionNames) > 0, fn($q) => $q->whereNotIn('name', $usedRegionNames))
            ->orderBy('name')
            ->get();

        $regions = Region::select('regions.id AS id', 'regions.name AS region', 'users.name', 'regions.created_at AS start_date')
            ->leftJoin('users', 'users.id', '=', 'regions.cordinator_id')
            ->get(); 
        return view('regions.regions', [
            'mikoa' => $mikoa,
            'cordinatorsCreate' => $cordinatorsCreate,
            'regions' => $regions,
            'userData' => $userData,
            'userRole' => $userRole,
            'paginate' => $request->session()->get('pagination_number'),
        ]);
    }

    public function Create(Request $request)
    {
        try {
            $regions = new Region();
            $regions->name = $request->name;
            $regions->cordinator_id = $request->cordinator;
            $regions->save();
            return redirect('regions')->with('sweet_success', 'Region added successfully.');
        } catch (Exception $e) {
        }
    }

    
    public function Search()
    {
        $querry = $_GET['search_querry'];

        if ($querry != null) {
            $userData = auth()->user();
            $id = $userData->id;
            $userRole = DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->where('users.id', $id)
                ->select('roles.role')
                ->first();
            $assignedCordinatorIds = Region::pluck('cordinator_id')->toArray();
            $cordinatorsCreate = User::where('role_id', 2)
                ->whereNotIn('id', $assignedCordinatorIds)
                ->get();

            $usedRegionNames = Region::pluck('name')->filter()->toArray();
            $mikoa = Mikoa::query()
                ->when(count($usedRegionNames) > 0, fn($q) => $q->whereNotIn('name', $usedRegionNames))
                ->orderBy('name')
                ->get();

            $regions = Region::select('regions.id AS id', 'regions.name AS region', 'users.name', 'regions.created_at AS start_date')
                ->leftJoin('users', 'users.id', '=', 'regions.cordinator_id')
                ->where('regions.name', 'LIKE', '%' . $querry . '%')
                ->orWhere('users.name', 'LIKE', '%' . $querry . '%')
                ->paginate(10);
            return view('regions.regions', [
                'mikoa' => $mikoa,
                'cordinatorsCreate' => $cordinatorsCreate,
                'regions' => $regions,
                'userData' => $userData,
                'userRole' => $userRole,
            ]);
        } else {
            return redirect('regions');
        }
    }

    public function editRegion($id) {

        $region = Region::find($id);
        if (!$region) {
            return response()->json([
                'status' => 404,
                'message' => 'Region not found.',
            ], 404);
        }

        $currentCoordinatorId = $region->cordinator_id;

        // Coordinators already assigned to OTHER regions
        $assignedOtherCoordinatorIds = Region::query()
            ->whereNotNull('cordinator_id')
            ->where('id', '!=', $region->id)
            ->pluck('cordinator_id')
            ->toArray();

        $cordinators = User::query()
            ->where('role_id', 2)
            ->when(count($assignedOtherCoordinatorIds) > 0, function ($q) use ($assignedOtherCoordinatorIds, $currentCoordinatorId) {
                $q->where(function ($qq) use ($assignedOtherCoordinatorIds, $currentCoordinatorId) {
                    $qq->whereNotIn('id', $assignedOtherCoordinatorIds);
                    if ($currentCoordinatorId) {
                        $qq->orWhere('id', $currentCoordinatorId);
                    }
                });
            })
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json([
            'status' => 200,
            'region' => $region,
            'cordinators' => $cordinators,
        ]);

    }

    public function updateRegion(Request $request) {

        try {
            $update = Region::find($request->region_id);
            if (!$update) {
                return redirect('regions')->with('sweet_error', 'Region not found.');
            }

            $update->name = $request->name;

            if ($request->filled('cordinator')) {
                $update->cordinator_id = $request->cordinator;
            }

            if ($update->save()) {
                return redirect('regions')->with('sweet_success', 'Region Updated Successfully.');
            }

            return redirect('regions')->with('sweet_error', 'Failed to update region.');
        } catch (Exception $e) {
            return redirect('regions')->with('sweet_error', 'Failed to update region.');
        }

    }

    public function delRegion(Request $request) {
        $region = Region::find($request->id);


        if($region->delete()){
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);

    }

    public function selRegion(){
        $regions = Region::select('*')->get();
        return view('regions.regionSelect', ['regions' => $regions]);
    }
}
