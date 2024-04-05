<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCenter;
use App\Models\Center;  
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InventoryRequest;
use Illuminate\Support\Facades\DB;


class InventoryController extends Controller
{
    public function getInventory() {
        // $inventory_lists = Inventory::all();

        $userData = auth()->user();
        $id = $userData->id;
        $userRole = DB::table('users')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->where('users.id', $id)
                        ->select('roles.role')
                        ->first();

        $courses = Course::select('courses.name as name', 'courses.id as id')
        ->join('course_centers', 'course_centers.course_id', '=', 'courses.id')
        ->join('centers', 'centers.id', '=', 'course_centers.center_id')
        ->where('centers.hod_id', '=', auth()->user()->id)->get();

        $reg_inventory = Inventory::select('inventories.*', 'courses.name as course_name', 'centers.name as cName', 'districts.name as distName')
        ->Join('centers', 'centers.id', '=', 'inventories.center_id')
        ->Join('courses', 'courses.id', '=', 'inventories.course_id')
        ->Join('districts', 'centers.district_id', '=', 'districts.id')
        ->Join('regions', 'regions.id', '=', 'districts.region_id')
        ->where('regions.cordinator_id', '=', auth()->user()->id)
        ->get();

        $dist_inventory = Inventory::select('inventories.*', 'courses.name as course_name', 'centers.name as cName')
        ->Join('centers', 'centers.id', '=', 'inventories.center_id')
        ->Join('courses', 'courses.id', '=', 'inventories.course_id')
        ->Join('districts', 'centers.district_id', '=', 'districts.id')
        ->where('districts.cordinator_id', '=', auth()->user()->id)
        ->get();

        $admin_inventory = Inventory::select('inventories.*', 'courses.name as course_name', 'centers.name as cName', 'districts.name as distName', 
        'regions.name as rName')
        ->Join('centers', 'centers.id', '=', 'inventories.center_id')
        ->Join('courses', 'courses.id', '=', 'inventories.course_id')
        ->Join('districts', 'centers.district_id', '=', 'districts.id')
        ->Join('regions', 'regions.id', '=', 'districts.region_id')
        ->get();


        $inventory_lists = DB::table('inventories')
                                ->join('courses', 'inventories.course_id', '=', 'courses.id')
                                ->join('centers', 'centers.id', '=', 'inventories.center_id')
                                ->where('centers.hod_id', '=', auth()->user()->id)
                                ->select('inventories.*', 'courses.name as course_name')
                                ->get();
        return view('centers.inventory_lists', compact('inventory_lists', 'userData', 'userRole', 'courses', 'reg_inventory', 'dist_inventory', 'admin_inventory'));
    }

    public function getInventoryRequest(){
        // DB::table('users')
        $userData = auth()->user();
        $id = $userData->id;
        $userRole= DB::table('users')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->where('users.id', $id)
                        ->select('roles.role')
                        ->first();

        $inventoryRequests = DB::table('inventory_requests')
                                ->join('courses', 'inventory_requests.course_id', '=', 'courses.id')
                                ->select('inventory_requests.*', 'courses.name as course_name')
                                ->get();


        // $inventoryRequests = InventoryRequest::all();
        return view('centers.inventory_requests', compact('inventoryRequests', 'userData', 'userRole'));
    }

    public function store(Request $request)
    {
      

            $centerId = Center::select('id')
            ->where('hod_id', '=', auth()->user()->id)->first();

            $inventory = new Inventory();

            $inventory->name = $request->name;
            $inventory->number = $request->number;
            $inventory->course_id = $request->course;
            $inventory->condition = $request->condition;
            $inventory->center_id = $centerId->id;
            $inventory->save();
            return redirect()->back();

        //         return redirect('inventory')->with('success', 'Inventory added');
        //     }else {
        //         return redirect('inventory')->with('error', 'Failed to add Inventory');
        //     }

        // } catch (\Throwable $th) {
        //     return redirect('inventory')->with('error', 'Failed to add Inventory');
        // }

    }

    public function edit($id)
    {
        $inventory = Inventory::find($id);
        return response()->json(
            [
            'status' => 200,
            'inventory' => $inventory
        ]);
    }

    public function update(Request $request)
    {
        $inventory = Inventory::find($request->inv_id);

        try {
            $inventory->name = $request->name;
            $inventory->number = $request->number;
            $inventory->course_id = $request->course;
            $inventory->condition = $request->condition;

            $inventory->save();

            return redirect('inventory')->with('success', "Inventory Updated Successiful");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('inventory')->with('error', "Failed to add inventory");;
        }
    }

    public function delete(Request $request) {
        $inventory = Inventory::find($request->id);

        if($inventory->delete()){
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);
    }
}