<?php

namespace App\Http\Controllers;

use App\Mail\password;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;



class UserController extends Controller
{

    public function GetUsers(){
       
        $roles=Role::all();
        $users=User::select('users.id','users.name','users.phone_number','users.email','roles.role')
                    ->leftJoin('roles','users.role_id','=','roles.id')
                    ->paginate(10);
        return view('users.users',['roles' => $roles,'users'=>$users]);
    }

    public function UpdateForm($id){
        
         $user=User::select('users.id','users.name','users.phone_number','users.email','roles.role','roles.id AS role_id')
                    ->leftJoin('roles','users.role_id','=','roles.id')
                    ->where('users.id',$id)
                    ->first();
                    
    
        $roles=Role::all();
        $users=User::leftJoin('roles','users.role_id','=','roles.id')
                    ->paginate(10);
       
        return view('users.update_user',['user'=>$user,'roles' => $roles,'users'=>$users,'update_user'=>$user]);
        
       
    }

    public function Update(Request $request){
        try{
            $user=User::find($request->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->national_id=$request->nida;
        $user->role_id=$request->role;
        $user->save();
        return redirect('users')->with('success', 'User added successfully.');
      
            
        }
        catch(Exception $e){
            
        }
        
        
    }

    public function Create(Request $request){
       
        try{

            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $generated_password=Hash::make($request->name."123");
            $user->password=$generated_password;
            $user->role_id=$request->input('role');
            $user->save();
            try{
                Mail::to($request->email)
                   ->send(new password($request->name."123",$request->name));
               // ->send(new password());
              return redirect('users')->with('success', 'User added successfully.');
     
            }
            catch(\Exception $e){
                return $e->getMessage();
            }
          
        }
        catch(\Exception $e){
            return $e->getMessage();

        }
       
         

        
        
    }
}