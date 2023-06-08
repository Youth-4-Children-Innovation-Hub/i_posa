<?php

namespace App\Http\Controllers;
use App\Models\Center;
use App\Models\Region;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use App\Models\StudentCourses;

use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    //
    public function GetStudents(){
      $userData = auth()->user();
      $courses=Course::all();
      $id = $userData->id;
      $userRole= DB::table('users')
                      ->join('roles', 'users.role_id', '=', 'roles.id')
                      ->where('users.id', $id)
                      ->select('roles.role')
                      ->first();

        $centers=Center::all();
        $regions=Region::all();
        $students=Student::select('students.id','students.status','students.phone_number','students.name AS name','students.gender','students.profile_picture','centers.name AS center')
                        ->leftJoin('centers','students.center_id','=','centers.id')
                        ->paginate(10);
        return view('students.students',['centers'=>$centers,'regions'=>$regions,'students'=>$students,'userData'=>$userData,'userRole'=>$userRole,'courses'=>$courses]);
      //return Auth::User()->role_id;
    }

    public function Create(Request $request){
      
      //validating
      $rules=[
        
        'passport'=>'required|image',
        'letter'=>'required|mimes:pdf',
        'birth_certificate'=>'required|mimes:pdf',
        'gender'=>'required',
        'course_id'=>'required',
        'center'=>'required'
      ];

      $messages = [  
          'passport.required' => 'Please upload the passport', 
          'letter.required'=>'Please upload the letter',
          'letter.pdf'=>'The selected letter must be a pdf',
          'birth_certificate.required'=>'Please upload the birth certificate',
          'birth_certificate.pdf'=>'The selected certificate must be a pdf',
          'gender.required'=>'Select the Gender',
          'region.required'=>'Select the Region',
          'center.required'=>'Select the Center'
        
        ];

        
          $validator = Validator::make($request->all(), $rules, $messages);
          if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $destination_letters='public/students/letters/'.$request->name.'_'.$request->phone_number;
        $destination_certificates='public/students/certificates/'.$request->name.'_'.$request->phone_number;
        $destination_passports='public/students/passports/'.$request->name.'_'.$request->phone_number;
       
        $file_letter = Storage::allFiles($destination_letters);
        $file_certificate=Storage::allFiles($destination_certificates);
        $file_passports=Storage::allFiles($destination_passports);

        if(sizeof($file_letter)>0){
          echo( Storage::path($file_letter[0]));
         Storage::delete($file_letter[0]);
        }
        if(sizeof($file_certificate)>0){
          echo var_dump($file_certificate);
          Storage::delete($file_certificate[0]);
        }
        if(sizeof($file_passports)>0){
          echo sizeof($file_passports);
          Storage::delete($file_passports[0]);
        }
       
       $path_passport=$request->file('passport')->storeAs($destination_passports,$request->file('passport')->getClientOriginalName());
      
       $path_letter=$request->file('letter')->storeAs($destination_letters,$request->file('letter')->getClientOriginalName());
      
       $path_certificate=$request->file('birth_certificate')->storeAs($destination_certificates,$request->file('birth_certificate')->getClientOriginalName());
        
     try{
        $student=new Student();
        $student->name=$request->name;
        $student->phone_number=$request->phone_number;
        $student->gender=$request->gender;
        $student->email="";
        $student->status="continous";
        $student->date_of_birth=$request->dob;
        $student->center_id=$request->center;
        $student->profile_picture=Storage::path($path_passport);
        $student->letter=Storage::path($path_letter);
        $student->birth_certificate=Storage::path($path_certificate);
        $student->save();
        $student_id=Student::select('id')
                            ->where('name',$request->name)
                            ->where('phone_number',$request->phone_number)
                            ->first();
       for($i=0; $i<sizeof($request->course_id); $i++){
        $student_courses=new StudentCourses();
        $student_courses->student_id=$student_id->id;
        $student_courses->course_id=$request->course_id[$i];
        $student_courses->state="not complete";
        $student_courses->save();
       }
       return redirect('students')->with('success', 'User added successfully.');
       
        
      }
      catch(\Exception $e){
        return $e->getMessage();
      }
      
      
      
        
    }
}