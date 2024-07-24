<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCenter;
use App\Models\Center;  
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Equipment;
use App\Models\InventoryRequest;
use Illuminate\Support\Facades\DB;


class InventoryController extends Controller
{
    public function getInventory() {

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

        $inv_type = Equipment::select('equipment.*')
        ->join('centers', 'centers.id', '=', 'equipment.center_id')
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

        $admin_inventory = Equipment::select('equipment.*', 'centers.name as cName', 'districts.name as distName', 
        'regions.name as rName')
        ->Join('centers', 'centers.id', '=', 'equipment.center_id')
        ->Join('districts', 'centers.district_id', '=', 'districts.id')
        ->Join('regions', 'regions.id', '=', 'districts.region_id')
        ->get();


        $inventory_lists = DB::table('inventories')
                                ->join('courses', 'inventories.course_id', '=', 'courses.id')
                                ->join('centers', 'centers.id', '=', 'inventories.center_id')
                                ->where('centers.hod_id', '=', auth()->user()->id)
                                ->select('inventories.*', 'courses.name as course_name')
                                ->get();
        return view('centers.inventory_lists', compact('inventory_lists', 'userData', 'userRole', 'courses', 'reg_inventory', 'dist_inventory',
         'admin_inventory', 'inv_type'));
    }

    public function getInventoryType(){
        $inventory_types = DB::table('equipment')
                                ->join('centers', 'centers.id', '=', 'equipment.center_id')
                                ->where('centers.hod_id', '=', auth()->user()->id)
                                ->select('equipment.*')
                                ->get();
        return view('centers.inventory_type', compact('inventory_types'));
    }

    public function nationalInventory($id){
        $inventory_lists = DB::table('inventories')
        ->join('courses', 'inventories.course_id', '=', 'courses.id')
        ->join('centers', 'centers.id', '=', 'inventories.center_id')
        ->where('centers.id', '=', $id)
        ->select('inventories.*', 'courses.name as course_name')
        ->get();
        return view('centers.national_inventory', compact('inventory_lists'));
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
            $inventory->code = $request->code;
            $inventory->use_status = $request->usage;
            $inventory->course_id = $request->course;
            $inventory->center_id = $centerId->id;
            $inventory->save();

            $equipment = Equipment::where('name', $request->name)
            ->where('center_id', $centerId->id)
            ->first();
            
            // If the equipment record exists, increment the `in_use` value
            if ($request->usage == 'use') {
                $equipment->inuse = $equipment->inuse + 1;
                $equipment->total = $equipment->total + 1;
                $equipment->save();
                return redirect('inventory')->with('success', 'Inventory added successfully');
            } elseif($request->usage == 'store'){
                $equipment->total = $equipment->total + 1;
                $equipment->save();
                return redirect('inventory')->with('success', 'Inventory added successfully');
            }else{
                return redirect('inventory')->with('error', 'Failed to add Inventory due to wrong input');
            }


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
            $inventory->code = $request->code;
            $inventory->course_id = $request->course;

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

    public function addType(Request $request){
        // $role = Role::select('roles.role')
        // ->join('users', 'roles.id', '=', 'users.role_id')
        // ->where('users.id', '=', auth()->user()->id)->first();

        $role = auth()->user()->role->role;
       

        if( $role == 'head of center'){

            $centerId = Center::select('id')
            ->where('hod_id', '=', auth()->user()->id)->first();
        }
            
        try{
            $inventory_type = New Equipment();
            $inventory_type->name = $request->name;
            $inventory_type->center_id = $centerId->id;
            $inventory_type->save();
            
            return redirect()->back()->with('success', "Inventory type added successfully");
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', "Failed to add inventory type");
        }
    }

    public function updateType(Request $request){
        $inventory_type = Equipment::find($request->id);

        try {
            $inventory_type->name = $request->name;
            $inventory_type->save();

            return redirect()->back()->with('success', "Inventory Updated Successiful");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', "Failed to update inventory");;
        }
    }

    public function deleteType(){
        $inventory_type = Equipment::find($request->id);

        if($inventory_type->delete()){
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);
    }
}
