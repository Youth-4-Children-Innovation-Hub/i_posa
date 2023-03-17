<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class UserController extends Controller
{

    public function GetUsers(){
        $role=Role::all();
        return view('users.users',['roles' => $role]);
    }
}
