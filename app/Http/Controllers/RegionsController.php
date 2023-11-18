<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Region;
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
        $cordinators = User::where('role_id', 2)
            ->get();

        $regions = Region::select('regions.id AS id', 'regions.name AS region', 'users.name', 'regions.created_at AS start_date')
            ->leftJoin('users', 'users.id', '=', 'regions.cordinator_id')
            ->paginate($request->session()->get('pagination_number'));
        return view('regions.regions', ['cordinators' => $cordinators, 'regions' => $regions, 'userData' => $userData, 'userRole' => $userRole, 'paginate' => $request->session()->get('pagination_number')]);
    }

    public function Create(Request $request)
    {
        try {
            $regions = new Region();
            $regions->name = $request->name;
            $regions->cordinator_id = $request->cordinator;
            $regions->save();
            return redirect('regions')->with('success', 'User added successfully.');
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
            $cordinators = User::where('role_id', 2)
                ->get();

            $regions = Region::select('regions.id AS id', 'regions.name AS region', 'users.name', 'regions.created_at AS start_date')
                ->leftJoin('users', 'users.id', '=', 'regions.cordinator_id')
                ->where('regions.name', 'LIKE', '%' . $querry . '%')
                ->orWhere('users.name', 'LIKE', '%' . $querry . '%')
                ->paginate(10);
            return view('regions.regions', ['cordinators' => $cordinators, 'regions' => $regions, 'userData' => $userData, 'userRole' => $userRole]);
        } else {
            return redirect('regions');
        }
    }

    public function editRegion($id) {

        $region = Region::find($id);
        return response()->json([
            "status" => 200,
            "region" => $region,
        ]);

    }

    public function updateRegion(Request $request) {

        $update = Region::find($request->region_id);
        $update->name = $request->name;

        if($request->cordinaor) {
            $update->cordinator_id = $request->cordinator;
        }

        if($update->save()) {
            return redirect('regions')->with('success', 'Region Updated Successfully.');
        }

    }

    public function delRegion(Request $request) {
        $region = Region::find($request->id);


        if($region->delete()){
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);

    }
}
