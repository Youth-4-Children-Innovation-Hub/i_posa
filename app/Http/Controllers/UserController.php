<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;


class UserController extends Controller
{

    public function GetUsers(){
        $roles=Role::all();
        $users=User::leftJoin('roles','users.role_id','=','roles.id')
                    ->get();
        return view('users.users',['roles' => $roles,'users'=>$users]);
    }
}
