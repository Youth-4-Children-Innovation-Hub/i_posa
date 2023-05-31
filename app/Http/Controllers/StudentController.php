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





class StudentController extends Controller
{
    //
    public function GetStudents(){
      $userData = auth()->user();
      $id = $userData->id;
      $userRole= DB::table('users')
                      ->join('roles', 'users.role_id', '=', 'roles.id')
                      ->where('users.id', $id)
                      ->select('roles.role')
                      ->first();

        $centers=Center::all();
        $regions=Region::all();
        $students=Student::select('students.id','students.name AS name','students.gender','students.profile_picture','centers.name AS center')
                        ->leftJoin('centers','students.center_id','=','centers.id')
                        ->paginate(10);
        return view('students.students',['centers'=>$centers,'regions'=>$regions,'students'=>$students,'userData'=>$userData,'userRole'=>$userRole]);
      //return Auth::User()->role_id;
    }

    public function Create(Request $request){
        
      $rules=[
        
        'passport'=>'required|image',
        'letter'=>'required|mimes:pdf',
        'birth_certificate'=>'required|mimes:pdf',
        'gender'=>'required',
        'region'=>'required',
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
        $filename="passport.png";
        $path_passport=$request->file('passport')->storeAs($request->nida,$filename,'public');
      
        $filename="letter.pdf";
        $path_letter=$request->file('letter')->storeAs($request->nida,$filename,'public');
      
      

        $filename="birth_certificate.pdf";
        $path_certificate=$request->file('birth_certificate')->storeAs($request->nida,$filename,'public');
      try{
        $student=new Student();
        $student->name=$request->name;
        $student->age=$request->age;
        $student->gender=$request->gender;
        $student->nida=$request->nida;
        $student->center_id=$request->center;
        $student->region_id=$request->region;
        $student->profile_picture="/storage/".$path_passport;
        $student->letter="/storage/".$path_letter;
        $student->birth_certificate="/storage/".$path_certificate;
        $student->save();
        return redirect('students')->with('success', 'User added successfully.');
      
      }
      catch(\Exception $e){
      }
      
      
      
      
        
    }
}