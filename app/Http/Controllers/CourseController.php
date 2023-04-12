<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Course;

class CourseController extends Controller
{
    public function GetCourses(){
        $centers=Center::all();
        $courses=Course::select('courses.name','centers.name AS center')
                        ->leftJoin('centers','courses.center_id','=','centers.id')
                        ->paginate(10);
        return view('courses.courses',['centers'=>$centers,'courses'=>$courses]);
   
    }

    public function Create(Request $request){
        try{
            $course=new Course();
        $course->name=$request->name;
        $course->center_id=$request->center;
        $course->save();
        return redirect('courses')->with('success', 'User added successfully.');
     
        }
        catch(\Exception $e){
            
        }
        
    }
}