<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
class CourseController extends Controller
{
    public function GetCourses(){
        $centers=Center::all();
        $courses=Course::select('courses.id','courses.name','centers.name AS center')
                        ->leftJoin('centers','courses.center_id','=','centers.id')
                        ->get();
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

    public function edit($id){
        $centers=Center::all();
        $courses=Course::select('courses.id','courses.name','centers.name AS center')
                        ->leftJoin('centers','courses.center_id','=','centers.id')
                        ->get();
                                  
                        // $currentCenter = DB::table('centers')->where('id', $id)->value('name');
                        $currentCenter = DB::table('centers')
                        ->join('courses', 'centers.id', '=', 'courses.center_id')
                        ->where('courses.id', $id)
                        ->select('centers.name', 'centers.id')
                        ->first();
        

                        // $currentCenter = DB::table('centers')
                        // ->join('courses', 'centers.id', '=', 'courses.center_id')
                        // ->where('courses.id', $id)
                        // ->select('centers.id')
                        // ->first()
                        // ->name;
    
               
       $courseEdit = DB::select('select id, name, center_id from courses where id = ?', [$id]);
       return view('editCourse', ['courseEdit'=>$courseEdit, 'centers'=>$centers,'courses'=>$courses, 'currentCenter'=>$currentCenter]);
    
    }

    public function update(Request $request,$id){
        $courseName = $request->input('name');
        $centerId= $request->input('center');
        DB::update('update courses set name = ?, center_id = ? where id = ?'
        ,[$courseName, $centerId, $id]);

        return redirect('courses');
    }
}