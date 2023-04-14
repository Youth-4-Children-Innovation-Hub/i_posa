<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Region;
use Exception;

class RegionsController extends Controller
{
    public function GetRegions(){

        $cordinators=User::where('role_id',2)
                            ->get();

        $regions=Region::select('regions.id AS id','regions.name AS region','users.name','regions.created_at AS start_date')
                       -> leftJoin('users','users.id','=','regions.cordinator_id')
                        ->paginate(10);
        return view('regions.regions',['cordinators'=>$cordinators,'regions'=>$regions]);
                            
    }

    public function Create(Request $request){
        try{
            $regions=new Region();
            $regions->name=$request->name;
            $regions->cordinator_id=$request->cordinator;
            $regions->save();
         return redirect('regions')->with('success', 'User added successfully.');
      
        }
        catch(Exception $e){
            
        }
       
    }
}