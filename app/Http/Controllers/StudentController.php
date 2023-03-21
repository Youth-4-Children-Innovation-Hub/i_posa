<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //
    public function GetStudents(){
        
      //  return view('students.students');
      return Auth::User()->role_id;
    }

    public function Create(){
        
    }
}