<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Course;
use App\Models\Role;
use App\Models\CourseCenter;
use App\Models\Teacher;
use Exception;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CourseController extends Controller
{
    public function GetCenterCourses()
    {
        $user_role = Role::select('role')
        ->join('users', 'roles.id', '=', 'users.role_id')
        ->where('users.id', '=', Auth::user()->id)
        ->first();
        
        if ($user_role->role == 'head of center') {
            $centerId = Center::select('centers.id')->where('centers.hod_id', '=', auth()->user()->id)->first();
            $teachers = Teacher::all()->where('created_by', '=', $centerId->id);
        } 
        
        $courses = Course::all();
        
        $centers = Center::all();
        $userData = Auth::user();

        $districtCourses = CourseCenter::select(
            'courses.name AS course',
            DB::raw('GROUP_CONCAT(DISTINCT centers.name SEPARATOR ", ") as centers'),
            DB::raw('GROUP_CONCAT(DISTINCT teachers.name SEPARATOR ", ") as teachers')
        )
            ->leftJoin('courses', 'course_centers.course_id', '=', 'courses.id')
            ->leftJoin('teachers', 'course_centers.teacher_id', '=', 'teachers.id')
            ->leftJoin('centers', 'course_centers.center_id', '=', 'centers.id')
            ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
            ->where('districts.cordinator_id', '=', $userData->id)
            ->groupBy('courses.name')
            ->get();

        $regionCourses = CourseCenter::select(
            'courses.name AS course',
            DB::raw('GROUP_CONCAT(DISTINCT centers.name SEPARATOR ", ") as centers')
        )
            ->leftJoin('courses', 'course_centers.course_id', '=', 'courses.id')
            ->leftJoin('centers', 'course_centers.center_id', '=', 'centers.id')
            ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
            ->leftJoin('regions', 'districts.region_id', '=', 'regions.id')
            ->where('regions.cordinator_id', '=', $userData->id)
            ->groupBy('courses.name')
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

        if ($user_role->role == 'head of center') {
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
                    'centerCourses' => $centerCourses,
                    'user_role' => $user_role 
                ]
            );

        } else{
            return view(
                'courses.courses',
                [
                    'courses' => $courses,
                    'centers' => $centers,
                    'centercourses1' => $centercourses1,
                    'userData' =>   $userData,
                    'districtCourses' => $districtCourses,
                    'regionCourses' =>  $regionCourses,
                    'centerCourses' => $centerCourses,
                    'user_role' => $user_role  
                ]
            );
        }    
            
        
    }

    public function Create(Request $request)
{
    try {
        $centerId = Center::select('id')->where('hod_id', Auth::user()->id)->value('id');
        
        // Create the course center relationship
        $coursecenter = new CourseCenter();
        $coursecenter->course_id = $request->course_id;
        $coursecenter->teacher_id = $request->teacher_id;
        $coursecenter->center_id = $centerId;
        $coursecenter->save();
        
        // If you also need to update course name, do it here BEFORE the redirect
        if ($request->has('name')) {
            $course = Course::find($request->course_id);
            if ($course) {
                $course->name = $request->name;
                $course->save();
            }
        }
        
        return redirect('courses')->with('sweet_success', 'Center course created successfully');
        
    } catch (Exception $e) {
        // Log the error for debugging
        \Log::error('Course creation failed: ' . $e->getMessage());
        
        return redirect()->back()
            ->with('sweet_error', 'Failed to create center course. Please try again.')
            ->withInput();
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
    
                return redirect('courses')->with('sweet_success', 'Center course updated successfully');
        
    } catch (Exception $e) {
        // Log the error for debugging
        \Log::error('Course creation failed: ' . $e->getMessage());
        
        return redirect()->back()
            ->with('sweet_error', 'Failed to update center course. Please try again.')
            ->withInput();
    }
        } else{
        $coursecenter = CourseCenter::find($request->course_center_id);

        try {
            $coursecenter->course_id = $request->course_id;
            $coursecenter->teacher_id = $request->teacher_id;
            $coursecenter->center_id = $request->center_id;

            $coursecenter->save();

            return redirect('courses')->with('sweet_success', 'Center course updated successfully');
        
    } catch (Exception $e) {
        // Log the error for debugging
        \Log::error('Course creation failed: ' . $e->getMessage());
        
        return redirect()->back()
            ->with('sweet_error', 'Failed to update center course. Please try again.')
            ->withInput();
    }
        }
    }

    public function deleteCourse(Request $request)
    {
        $course_center = CourseCenter::find($request->id);

        if($course_center->delete()){
            return response()->json([
                'status' => true,
                'message' => 'Course deleted sucessfully'
        
                   ]);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Failed to delete course'  
        ]);

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

    public function getCourseDetails(Request $request)
    {
        $courseName = $request->course_name;
        $user = Auth::user();
        $role = $user->role->role;

        $query = CourseCenter::select(
            'centers.name as center',
            'districts.name as district',
            'regions.name as region',
            'teachers.name as teacher'
        )
        ->join('courses', 'course_centers.course_id', '=', 'courses.id')
        ->join('centers', 'course_centers.center_id', '=', 'centers.id')
        ->join('districts', 'centers.district_id', '=', 'districts.id')
        ->join('regions', 'districts.region_id', '=', 'regions.id')
        ->join('teachers', 'course_centers.teacher_id', '=', 'teachers.id')
        ->where('courses.name', $courseName);

        if ($user->role_id == 3) {
            $query->where('districts.cordinator_id','=', $user->id);
        } elseif ($user->role_id == 2                                                           ) {
            $query->where('regions.cordinator_id', $user->id);
        }
        // else, admin or other roles see all

        $details = $query->get();

        return response()->json([
            'status' => true,
            'details' => $details
        ]);
    }

   
    public function CreateNew(Request $request)
    {
        try {
            $course = new Course();
            $course->name = $request->name;
            $course->save();
            return redirect('courses')->with('sweet_success', 'Course created successfully');
        } catch (Exception $e) {
        }
    }

}
