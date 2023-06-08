<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;


class TeachersController extends Controller
{
    public function GetTeachers(){
        $teachers=Teacher::orderBy('created_at','DESC')
                            ->get();
        return view('centers.teachers',['teachers'=>$teachers]);
    }

    public function Create(Request $request){
        try{
            $teacher=new Teacher();
            $teacher->name=$request->name;
            $teacher->email=$request->email;
            $teacher->phone_number=$request->phone_number;
            $teacher->created_by=Auth::user()->id;
            $teacher->save();
            return redirect('teachers');
            
    
        }
        catch(Exception $e){
            return $e->getMessage();
        }
           }
}