<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function GetUsers(){
        return view('users.users');
    }
}
