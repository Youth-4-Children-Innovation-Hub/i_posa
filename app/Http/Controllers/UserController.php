<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class UserController extends Controller
{

    public function GetUsers(){
        $roles=Role::all();
        $users=User::leftJoin('roles','users.role_id','=','roles.id')
                    ->get();
        return view('users.users',['roles' => $roles,'users'=>$users]);
    }

    public function Create(Request $request){
       
        try{

            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->name."123");
            $user->role_id=$request->input('role');
            $user->save();
               return redirect('users')->with('success', 'User added successfully.');
      
        }
        catch(\Exception $e){

        }
       
         

        
        
    }
}