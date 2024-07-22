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
        $centerId = Center::select('centers.id')->where('centers.hod_id', '=', auth()->user()->id)->first();

        $courses = Course::all();
        $teachers = Teacher::all()->where('created_by', '=', $centerId->id);
        $centers = Center::all();
        $userData = Auth::user();

        $districtCourses = Course::select('courses.*')
        ->distinct()
        ->Join('course_centers', 'course_centers.course_id', '=', 'courses.id')
        ->Join('centers', 'course_centers.center_id', '=', 'centers.id')
        ->Join('districts', 'districts.id', '=', 'centers.district_id')
        ->where('districts.cordinator_id', '=', $userData->id)
        ->get();

        $regionCourses = Course::select('courses.*')
        ->distinct()
        ->Join('course_centers', 'course_centers.course_id', '=', 'courses.id')
        ->Join('centers', 'course_centers.center_id', '=', 'centers.id')
        ->Join('districts', 'districts.id', '=', 'centers.district_id')
        ->Join('regions', 'regions.id', '=', 'districts.region_id')
        ->where('regions.cordinator_id', '=', $userData->id)
        ->get();

        $centerCourses = Course::select('courses.*')
        ->join('course_centers', 'course_centers.course_id', '=', 'courses.id')
        ->join('centers', 'course_centers.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', auth()->user()->id)
        ->get();

        $centercourses1 = CourseCenter::select('courses.name AS course1', 'courses.id as id1', 'teachers.name AS teacher1', 'course_centers.id AS id')
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
                'userData' =>   $userData,
                'districtCourses' => $districtCourses,
                'regionCourses' =>  $regionCourses,
                'centerCourses' => $centerCourses 
            ]
        );
    }
    public function Create(Request $request)
    {
        try {
            $centerId = Center::Select('id')->where('hod_id', Auth::user()->id)->value('id');
            $coursecenter = new CourseCenter();
            $coursecenter->course_id = $request->course_id;
            $coursecenter->teacher_id = $request->teacher_id;
            $coursecenter->center_id = $centerId;
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

    public function nationalCourses($id){
        $courses = Course::all();
        $teachers = Teacher::all()->where('created_by', '=', Auth()->user()->id);
        $centers = Center::all();
        $userData = Auth::user();

      

        $centercourses1 = CourseCenter::select('courses.name AS course1', 'teachers.name AS teacher1', 'course_centers.id AS id')
            ->join('teachers', 'teachers.id', '=', 'course_centers.teacher_id')
            ->join('courses', 'courses.id', '=', 'course_centers.course_id')
            ->join('centers', 'centers.id', '=', 'course_centers.center_id')
            ->join('users', 'users.id', '=', 'centers.hod_id')
            ->where('centers.id', '=', $id)
            ->get();
            
        return view(
            'courses.nationalCourse',
            [
                'teachers' => $teachers,
                'courses' => $courses,
                'centers' => $centers,
                'centercourses1' => $centercourses1,
                'userData' =>   $userData
            ]
        );
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
        if( auth()->user()->role->role == 'admin'){
            try {
                $course = Course::find($request->courseId);
                $course->name = $request->course;
                $course->save();
    
                return redirect('courses')->with('success', "Course Center Updated Successiful");
            } catch (\Throwable $th) {
                //throw $th;
                return redirect('courses');
            }
        } else{
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

    public function Search()
    {
        $querry = $_GET['search_querry'];
        if ($querry != null) {
            $courses = Course::all();
            $teachers = Teacher::all();
            $centers = Center::all();
            $userData = Auth::user();
    
            $centercourses = CourseCenter::select('course_centers.id', 'courses.name AS course', 'teachers.name AS teacher', 'centers.name AS center')
                ->leftJoin('teachers', 'teachers.id', '=', 'course_centers.teacher_id')
                ->leftJoin('courses', 'courses.id', '=', 'course_centers.course_id')
                ->leftJoin('centers', 'centers.id', '=', 'course_centers.center_id')
                ->orderBy('course_centers.created_at', 'DESC')
                ->get();
                
                //for the head of center
    
            $centercourses1 = CourseCenter::select('courses.name AS course1', 'teachers.name AS teacher1', 'course_centers.id AS id')
                ->leftJoin('teachers', 'teachers.id', '=', 'course_centers.teacher_id')
                ->leftJoin('courses', 'courses.id', '=', 'course_centers.course_id')
                ->leftJoin('centers', 'centers.id', '=', 'course_centers.center_id')
                ->leftJoin('users', 'users.id', '=', 'centers.hod_id')
                ->where('users.id', '=', $userData->id)
                ->where('courses.name', 'LIKE', '%' . $querry . '%')
                ->orWhere('teachers.name', 'LIKE', '%' . $querry . '%')
                ->get();
                
            return view(
                'courses.courses',
                [
                    'teachers' => $teachers,
                    'courses' => $courses,
                    'centers' => $centers,
                    'centercourses' => $centercourses,
                    'centercourses1' => $centercourses1,
                    'userData' =>   $userData
                ]
            );
        } else {
            return redirect('courses');
        }
    }
}
