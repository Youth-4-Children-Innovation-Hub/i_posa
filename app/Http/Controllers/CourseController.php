<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Course;
use App\Models\CourseCenter;
use App\Models\Teacher;
use Exception;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CourseController extends Controller
{
    public function GetCenterCourses()
    {
        $courses = Course::all();
        $teachers = Teacher::all();
        $centers = Center::all();
        $userData = Auth::user();

        // $centercourses = Cours::select('course_centers.id', 'courses.name AS course')
        //     ->leftJoin('courses', 'courses.id', '=', 'course_centers.course_id')
        //     ->orderBy('courses.created_at', 'DESC')
        //     ->get();
            
            //for the head of center

        $centercourses1 = CourseCenter::select('courses.name AS course1', 'teachers.name AS teacher1', 'course_centers.id AS id')
            ->leftJoin('teachers', 'teachers.id', '=', 'course_centers.teacher_id')
            ->leftJoin('courses', 'courses.id', '=', 'course_centers.course_id')
            ->leftJoin('centers', 'centers.id', '=', 'course_centers.center_id')
            ->leftJoin('users', 'users.id', '=', 'centers.hod_id')
            ->where('users.id', '=', $userData->id)
            ->get();
            
        return view(
            'courses.courses',
            [
                'teachers' => $teachers,
                'courses' => $courses,
                'centers' => $centers,
                'centercourses1' => $centercourses1,
                'userData' =>   $userData
            ]
        );
    }
    public function Create(Request $request)
    {
        try {
            $coursecenter = new CourseCenter();
            $coursecenter->course_id = $request->course_id;
            $coursecenter->teacher_id = $request->teacher_id;
            $coursecenter->center_id = $request->center_id;
            $coursecenter->save();
            return redirect('courses');
        } catch (Exception $e) {
        }
    }
    public function CreateNew(Request $request)
    {
        try {
            $course = new Course();
            $course->name = $request->name;
            $course->save();
            return redirect('courses');
        } catch (Exception $e) {
        }
    }
    // public function GetCourses(){
    //     $userData = auth()->user();
    //     $id = $userData->id;
    //     $userRole= DB::table('users')
    //                     ->join('roles', 'users.role_id', '=', 'roles.id')
    //                     ->where('users.id', $id)
    //                     ->select('roles.role')
    //                     ->first();

    //     $centers=Center::all();
    //     $courses=Course::select('courses.id','courses.name','centers.name AS center')
    //                     ->leftJoin('centers','courses.center_id','=','centers.id')
    //                     ->paginate(10);
    //     return view('courses.courses',['centers'=>$centers,'courses'=>$courses,'userData'=>$userData, 'userRole'=>$userRole]);

    // }

    // public function Create(Request $request){
    //     try{
    //         $course=new Course();
    //     $course->name=$request->name;
    //     $course->center_id=$request->center;
    //     $course->save();
    //     return redirect('courses')->with('success', 'User added successfully.');

    //     }
    //     catch(\Exception $e){

    //     }

    // }

    // public function edit($id){
    //     $centers=Center::all();
    //     $courses=Course::select('courses.id','courses.name','centers.name AS center')
    //                     ->leftJoin('centers','courses.center_id','=','centers.id')
    //                     ->get();

    //                     // $currentCenter = DB::table('centers')->where('id', $id)->value('name');
    //                     $currentCenter = DB::table('centers')
    //                     ->join('courses', 'centers.id', '=', 'courses.center_id')
    //                     ->where('courses.id', $id)
    //                     ->select('centers.name', 'centers.id')
    //                     ->first();


    //                     // $currentCenter = DB::table('centers')
    //                     // ->join('courses', 'centers.id', '=', 'courses.center_id')
    //                     // ->where('courses.id', $id)
    //                     // ->select('centers.id')
    //                     // ->first()
    //                     // ->name;


    //    $courseEdit = DB::select('select id, name, center_id from courses where id = ?', [$id]);
    //    return view('editCourse', ['courseEdit'=>$courseEdit, 'centers'=>$centers,'courses'=>$courses, 'currentCenter'=>$currentCenter]);

    // }

    // public function update(Request $request,$id){
    //     $courseName = $request->input('name');
    //     $centerId= $request->input('center');
    //     DB::update('update courses set name = ?, center_id = ? where id = ?'
    //     ,[$courseName, $centerId, $id]);

    //     return redirect('courses');
    // }

    public function updateCourse(Request $request)
    {
        $coursecenter = CourseCenter::find($request->course_center_id);

        try {
            $coursecenter->course_id = $request->course_id;
            $coursecenter->teacher_id = $request->teacher_id;
            $coursecenter->center_id = $request->center_id;

            $coursecenter->save();

            return redirect('courses')->with('success', "Course Center Updated Successiful");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('courses');
        }
    }

    public function deleteCourse(Request $request)
    {
        $course_center = CourseCenter::find($request->id);

        if($course_center->delete()){
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);

    }

    public function deleteCourseAdmin(Request $request)
    {
        $course = Course::find($request->id);

        if($course->delete()){
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);

    }


    public function editCourse($id)
    {
        $course = CourseCenter::find($id);
        return response()->json([
            "status" => 200,
            "course_centers" => $course,
        ]);

    }
}
