<?php

namespace App\Http\Controllers;

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
        $userRole= DB::table('users')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->where('users.id', $id)
                        ->select('roles.role')
                        ->first();

        $inventory_lists = DB::table('inventories')
                                ->join('courses', 'inventories.course_id', '=', 'courses.id')
                                ->select('inventories.*', 'courses.name as course_name')
                                ->get();

        return view('centers.inventory_lists', compact('inventory_lists', 'userData', 'userRole'));
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

    public function store(){

    }
}
