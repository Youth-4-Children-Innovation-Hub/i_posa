<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseCenter;
use App\Models\Center;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PHPUnit\Event\Code\Test;

class TeachersController extends Controller
{
    public function GetTeachers()
    {
        $userRole = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->where('users.id', Auth::user()->id)
        ->select('roles.role as role')
        ->first();

        $userData = Auth::user();
        $teachers = Teacher::orderBy('created_at', 'DESC')
        ->get();

        $districtTeachers = Teacher::select('teachers.*', 'centers.name as centerName')
        ->Join('centers', 'centers.hod_id', '=', 'teachers.created_by')
        ->Join('districts', 'centers.district_id', '=', 'districts.id')
        ->where('districts.cordinator_id', '=', Auth::user()->id)
        ->get();

        $regionTeachers = Teacher::select('teachers.*', 'centers.name as centerName', 'districts.name as distName')
        ->Join('centers', 'centers.hod_id', '=', 'teachers.created_by')
        ->Join('districts', 'centers.district_id', '=', 'districts.id')
        ->Join('regions', 'regions.id', '=', 'districts.region_id')
        ->where('regions.cordinator_id', '=', Auth::user()->id)
        ->get();


         //for the head of center
         if($userRole->role == 'head of center'){
            $centerId = Center::select('centers.id as id')->where('centers.hod_id', '=', auth()->user()->id)->first();
            $teachers1 = Teacher::select('*')->where('created_by', '=', $centerId->id)->get();
         }
         

        //  $teachers1 = CourseCenter::select('course_centers.id AS id', 'teachers.name AS name1', 'teachers.email AS email1', 'teachers.phone_number AS phone_number1')
        //  ->leftJoin('teachers', 'teachers.id', '=', 'course_centers.teacher_id')
        //  ->leftJoin('centers', 'centers.id', '=', 'course_centers.center_id')
        //  ->leftJoin('users', 'users.id', '=', 'centers.hod_id')
        //  ->where('teachers.created_by', '=', $userData->id)
        //  ->get();  
        if($userRole->role == 'head of center'){  
            return view('centers.teachers', ['teachers1' => $teachers1]);
        } else{
            return view('centers.teachers', ['teachers' => $teachers, 'userData' => $userData, 'districtTeachers' => $districtTeachers, 'regionTeachers' =>  $regionTeachers]);
        }

       
    }

    public function nationalTeachers($id){
        $teachers1 = CourseCenter::select('course_centers.id AS id', 'teachers.name AS name1', 'courses.name AS course1', 'teachers.email AS email1', 'teachers.phone_number AS phone_number1')
        ->join('teachers', 'teachers.id', '=', 'course_centers.teacher_id')
        ->join('courses', 'courses.id', '=', 'course_centers.course_id')
        ->join('centers', 'centers.id', '=', 'course_centers.center_id')
        ->join('users', 'users.id', '=', 'centers.hod_id')
        ->where('centers.id', '=', $id)
        ->get();    
    return view('centers.nationalTeacher', ['teachers1' => $teachers1]);
    }

    public function Create(Request $request)
    {
        try {
            
            $centerId = Center::select('centers.id')->where('centers.hod_id', '=', auth()->user()->id)->first();
            $teacher = new Teacher();
            $teacher->name = $request->name;
            $teacher->gender = $request->gender;
            $teacher->qualification = 'qualified';
            $teacher->ANFE_training = $request->anfe;
            $teacher->email = $request->email;
            $teacher->phone_number = $request->phone_number;
            $teacher->created_by = $centerId->id;
            $teacher->save();
            return redirect('teachers');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function edit($id) {
        $teacher = Teacher::find($id);

        return response()->json(
            [
                'status' => 200,
                'teacher' => $teacher
            ]
        );
    }

    public function update(Request $request)
    {
        $teacher = Teacher::find($request->teacher_id);

        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->gender = $request->gender;
        $teacher->qualification = 'qualified';
        $teacher->ANFE_training = $request->anfe;
        $teacher->phone_number = $request->phone_number;
        $teacher->employer = $request->employer;

        if($teacher->save()) {
            return redirect('teachers')->with('success', 'Teacher Updated Successufil');
        }else {
            return redirect()->back()->with('error', 'Failed to Update Teacher');
        }
    }

    public function delete(Request $request)
    {
        $teacher = Teacher::find($request->id);

        if($teacher->delete()){
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);


    }

    public function Search()
    {
        $querry = $_GET['search_querry'];
        if ($querry != null) {
            $userData = auth()->user();
            $teachers1 = CourseCenter::select('course_centers.id AS id', 'teachers.name AS name1', 'courses.name AS course1', 'teachers.email AS email1', 'teachers.phone_number AS phone_number1')
            ->leftJoin('teachers', 'teachers.id', '=', 'course_centers.teacher_id')
            ->leftJoin('courses', 'courses.id', '=', 'course_centers.course_id')
            ->leftJoin('centers', 'centers.id', '=', 'course_centers.center_id')
            ->leftJoin('users', 'users.id', '=', 'centers.hod_id')
            ->where('users.id', '=', $userData->id)
            ->where('teachers.email', 'LIKE', '%' . $querry . '%')
            ->orWhere('courses.name', 'LIKE', '%' . $querry . '%')
            ->orWhere('teachers.name', 'LIKE', '%' . $querry . '%')
            ->get();    
            return view('centers.teachers', ['teachers1' => $teachers1]);
        } else {
            return redirect('teachers');
        }
    }
}
