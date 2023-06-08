<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;




class DistrictController extends Controller
{
    
    public function GetDistricts(Request $request){
        if(!$request->session()->exists('pagination_number')){
            $request->session()->put('pagination_number',3);
           
           }
            if($_GET){
                
                if(isset($_GET['number'])){
                    $number=  $_GET['number'];
                    $request->session()->put('pagination_number',$_GET['number']);
          
                 }
              
              
            }
          
        $districts=District::select('districts.Id','districts.name','regions.name AS region','users.name AS cordinator')
                            ->leftJoin('regions','districts.region_id','=','regions.id')
                            ->leftJoin('users','districts.cordinator_id','=','users.id')
                            ->paginate($request->session()->get('pagination_number'));
        $regions=Region::all();
        $district_cordinator_id=Role::select('id')
                                ->where('role','district cordinator')
                                ->first();
        $users=User::where('role_id',$district_cordinator_id->id)
                    ->get();
        return view('district.district',['cordinators'=>$users,'regions'=>$regions,'districts'=>$districts,'paginate'=>$request->session()->get('pagination_number')]);
      
    }

    public function Create (Request $request){
        try{
            $district=new District();
            $district->name=$request->name;
            $district->cordinator_id=$request->cordinator_id;
            $district->region_id=$request->region_id;
            $district->save();
            return redirect('districts')->with('success', 'User added successfully.');
      
        }
        catch(Exception $e){
            
        }
      
    }

    public function Search()
    {
        $querry= $_GET['search_querry'];
            if($querry != null) {
                $districts=District::select('districts.Id','districts.name','regions.name AS region','users.name AS cordinator')
                ->leftJoin('regions','districts.region_id','=','regions.id')
                ->leftJoin('users','districts.cordinator_id','=','users.id')
                ->where('districts.name','LIKE','%'.$querry.'%')
                ->orWhere('regions.name','LIKE','%'.$querry.'%')
                ->orWhere('users.name','LIKE','%'.$querry.'%')
                ->get();
$regions=Region::all();
$district_cordinator_id=Role::select('id')
                    ->where('role','district cordinator')
                    ->first();
$users=User::where('role_id',$district_cordinator_id->id)
        ->get();
return view('district.district',['cordinators'=>$users,'regions'=>$regions,'districts'=>$districts]);

            }
            else{
                return redirect('districts');
            }

        
    }
}