<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Region;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use App\Models\Role;
use App\Models\StudentCourses; 
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CoursesImport; 
use App\Imports\StudentsImport;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    //
    protected $center_location;

    public function setCenterLocation()
    {
        $this->center_location = Region::select('regions.name as rname', 'districts.name as dname')
            ->join('districts', 'districts.region_id', '=', 'regions.id')
            ->join('centers', 'districts.id', '=', 'centers.district_id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->first();
    }

    public function excelData()
    {
        return view('students.excel');
    }

    public function downloadTemplate()
    {
        $filePath = public_path('excel/student.xlsx'); 

        if (file_exists($filePath)) {
            return Response::download($filePath);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }

    public function GetStudents()
    {
        
        $userData = auth()->user();
        $courses = Course::all();
        $id = $userData->id;
        $userRole = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', $id)
            ->select('roles.role')
            ->first();

        $centers = Center::all();
        $courses = Course::all();
        $centerCourses = Course::select('courses.*')
        ->join('course_centers', 'course_centers.course_id', '=', 'courses.id')
        ->join('centers', 'course_centers.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', auth()->user()->id)
        ->get();
        $regions = Region::all();
        $students2 = Student::select('students.id', 'students.disability as disability', 'students.status', 'students.phone_number', 'students.name AS name', 'students.gender', 'students.profile_picture', 'centers.name AS center')
            ->leftJoin('centers', 'students.center_id', '=', 'centers.id')
            ->orderBy('students.created_at','DESC')
            ->paginate(100);

        $students = Student::select('students.*', 'centers.name AS center', 'courses.name AS course')
        ->leftJoin('centers', 'students.center_id', '=', 'centers.id')
        ->leftJoin('student_courses', 'student_courses.student_id', '=', 'students.id')
        ->leftJoin('courses', 'courses.id', '=', 'student_courses.course_id') 
        ->orderBy('students.created_at','DESC')
        ->get();
        
          
        //for the head of center

        $center1 = Center::select('centers.name AS centerName1', 'centers.id AS id')
            ->where('hod_id', '=', $userData->id)
            ->get();
        $students1 = Student::select('students.id AS id', 'students.disability as disability1', 'students.status AS status1', 'students.phone_number AS phone_number1',
         'students.name AS name1', 'students.gender AS gender1', 'courses.name AS course1')
            ->distinct()
            ->leftJoin('student_courses', 'student_courses.student_id', '=', 'students.id') 
            ->leftJoin('centers', 'students.center_id', '=', 'centers.id')
            ->leftJoin('users', 'users.id', '=', 'hod_id')
            ->leftJoin('courses', 'courses.id', '=', 'student_courses.course_id') 
            ->where('users.id', '=', $userData->id)
            ->get();
        
        $districtStudents =  Student::select('students.*', 'courses.name AS course2', 'centers.name AS centerName2')
           ->leftJoin('student_courses', 'student_courses.student_id', '=', 'students.id') 
           ->leftJoin('centers', 'students.center_id', '=', 'centers.id')
           ->leftJoin('districts', 'centers.district_id', '=', 'districts.id')
           ->leftJoin('courses', 'courses.id', '=', 'student_courses.course_id') 
           ->where('districts.cordinator_id', '=', $userData->id)
           ->get();  
           
           $regionStudents =  Student::select('students.*', 'courses.name AS course2', 'centers.name AS centerName2', 'districts.name as distName')
           ->join('student_courses', 'student_courses.student_id', '=', 'students.id') 
           ->join('centers', 'students.center_id', '=', 'centers.id')
           ->join('districts', 'centers.district_id', '=', 'districts.id')
           ->join('regions', 'regions.id', '=', 'districts.region_id')
           ->join('courses', 'courses.id', '=', 'student_courses.course_id') 
           ->where('regions.cordinator_id', '=', $userData->id)
           ->get();      
            
      
        return view('students.students', ['centers' => $centers, 'center1' => $center1, 'students1' => $students1, 'regions' => $regions,
        'districtStudents' => $districtStudents, 'students' => $students, 'userData' => $userData, 'userRole' => $userRole, 'courses' => $courses, 
        'regionStudents' => $regionStudents, 'centerCourses' => $centerCourses]);
        
    }

    public function nationalStudents($id){
        $courses = Course::all();
        $students = Student::select('students.*', 'centers.name AS center')
        ->Join('centers', 'students.center_id', '=', 'centers.id')
        ->where('centers.id', '=', $id)
        ->get();
        return view('students.nationalStudents', ['students' => $students, 'id' => $id, 'courses' => $courses]);

    }

    public function import(Request $request)
    {
      
        $import = new StudentsImport;
        Excel::import($import, $request->file('excel_file'));
        $errors = $import->getErrors();
        if (!empty($errors)) {
            $formattedErrors = [];

            foreach ($errors as $index => $error) {
                $formattedErrors[] = sprintf(
                    'Student: %s - Errors: %s',
                    $error['name'],
                    implode(', ', $error['errors'])
                );
            }

        return redirect()->back()->withErrors($formattedErrors)->withInput();
        }
        return redirect()->back()->with('success', 'Data imported successfully');
    }

    public function Create(Request $request)
    {
        //validating

        $rules = [
            'passport' => 'required|image',
            'letter' => 'required|mimes:pdf',
            'birth_certificate' => 'required|mimes:pdf',
            'name' => 'required',
            'reg_no' => 'required',
            'gender' => 'required',
            'disability' => 'required',
            'dob' => 'required',
            'ward' => 'required',
            'street' => 'required',
            'education_level' => 'required',
            'education_type' => 'required',
            'marital_status' => 'required',
            'employment_status' => 'required',
            'parent' => 'required',
            'parent_phone' => 'required',
            'pdissability' => 'required'
        ];

        $messages = [
            'letter.pdf' => 'The selected letter must be a pdf',
            'birth_certificate.pdf' => 'The selected certificate must be a pdf',
            'name.required' => 'Student name field is required',
            'reg_no.required' => 'Registration number field is required',
            'gender.required' => 'Gender field is required',
            'disability.required' => 'Student dissability field is required',
            'dob.required' => 'Date of birth field is required',
            'ward.required' => 'Ward field is required',
            'street.required' => 'Street field is required',
            'education_level.required' => 'Education level field is required',
            'education_type.required' => 'Education type field is required',
            'marital_status.required' => 'Marital staus field is required',
            'employment_status.required' => 'Employment status field is required',
            'parent.required' => 'Parent name field is required',
            'parent_phone.required' => 'Parent phone field is required',
            'pdissability.required' => 'Parent dissability field is required',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $destination_letters = 'public/students/letters/' . $request->name . '_' . $request->phone_number;
        $destination_certificates = 'public/students/certificates/' . $request->name . '_' . $request->phone_number;
        $destination_passports = 'public/students/passports/' . $request->name . '_' . $request->phone_number;

        $file_letter = Storage::allFiles($destination_letters);
        $file_certificate = Storage::allFiles($destination_certificates);
        $file_passports = Storage::allFiles($destination_passports);

        if (sizeof($file_letter) > 0) {
            echo (Storage::path($file_letter[0]));
            Storage::delete($file_letter[0]);
        }
        if (sizeof($file_certificate) > 0) {
            echo var_dump($file_certificate);
            Storage::delete($file_certificate[0]);
        }
        if (sizeof($file_passports) > 0) {
            echo sizeof($file_passports);
            Storage::delete($file_passports[0]);
        }

        $path_passport = $request->file('passport')->storeAs($destination_passports, $request->file('passport')->getClientOriginalName());

        $path_letter = $request->file('letter')->storeAs($destination_letters, $request->file('letter')->getClientOriginalName());

        $path_certificate = $request->file('birth_certificate')->storeAs($destination_certificates, $request->file('birth_certificate')->getClientOriginalName());

        $user_role = Role::select('role')
        ->join('users', 'roles.id', '=', 'users.role_id')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $this->setCenterLocation();
        $location = $this->center_location;

        $centerLocation1 = Region::select('regions.name as rname', 'districts.name as dname')
        ->join('districts', 'districts.region_id', '=', 'regions.id')
        ->join('centers', 'districts.id', '=', 'centers.district_id')
        ->where('centers.id', '=', $request->centerId)
        ->first();
     
        try {
            if ($user_role->role == 'head of center') {
                $centerId = Center::where('hod_id', Auth::user()->id)->value('id');
            } else {
                $centerId = $request->centerId;
            }
           
            $student = new Student();
            $student->name = $request->name;
            $student->registration_number = $request->reg_no;
            $student->date_of_birth = $request->dob;
            $student->gender = $request->gender;
            $student->nida = $request->nida;
            if ($user_role->role == 'head of center'){
                $student->region = $location->rname;
                $student->district = $location->dname;
            } else{
                $student->region = $centerLocation1->rname;
                $student->district = $centerLocation1->dname;
            } 
            $student->ward = $request->ward;
            $student->street = $request->street;
            $student->education_level = $request->education_level;
            $student->education_type = $request->education_type;
            $student->marital_status = $request->marital_status;
            $student->employment_status = $request->employment_status;
            $student->disability = $request->disability;
            $student->phone_number = $request->phone_number;
            $student->email = $request->student_email;   
            $student->center_id = $centerId;
            $student->profile_picture = Storage::path($path_passport);
            $student->birth_certificate = Storage::path($path_certificate);
            $student->letter = Storage::path($path_letter);
            $student->status = "continous";
            $student->stage = $request->stage;
            $student->save();

            $parent = new Guardian();
            $parent->name = $request->parent;
            $parent->phone = $request->parent_phone;
            $parent->email = $request->parent_email;
            $parent->address = $request->parent_address;
            $parent->occupation = $request->parent_occupation;
            $parent->disability = $request->pdissability;
            if ($user_role->role == 'head of center'){
                $parent->region = $location->rname;
                $parent->district = $location->dname;
            } else{
                $parent->region = $centerLocation1->rname;
                $parent->district = $centerLocation1->dname;
            } 
            $parent->ward = $request->pward;
            $parent->student_id = $student->id;
            $parent->save();

            $student_id = Student::select('id')
                ->where('name', $request->name)
                ->where('phone_number', $request->phone_number)
                ->first();
            for ($i = 0; $i < sizeof($request->course_id); $i++) {
                $student_courses = new StudentCourses();
                $student_courses->student_id = $student_id->id;
                $student_courses->course_id = $request->course_id[$i];
                $student_courses->state = "not complete";
                $student_courses->save();
            }
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
            'reg_no' => 'required',
            'gender' => 'required',
            'dissability' => 'required',
            'dob' => 'required',
            'ward' => 'required',
            'street' => 'required',
            'education_level' => 'required',
            'education_type' => 'required',
            'marital_status' => 'required',
            'employment_status' => 'required',
            'parent' => 'required',
            'parent_phone' => 'required',
            'pdissability' => 'required',
            'stage' => 'required'
        ];

        $messages = [
            'letter.pdf' => 'The selected letter must be a pdf',
            'birth_certificate.pdf' => 'The selected certificate must be a pdf',
            'name.required' => 'Student name field is required',
            'reg_no.required' => 'Registration number field is required',
            'gender.required' => 'Gender field is required',
            'disability.required' => 'Student dissability field is required',
            'dob.required' => 'Date of birth field is required',
            'ward.required' => 'Ward field is required',
            'street.required' => 'Street field is required',
            'education_level.required' => 'Education level field is required',
            'education_type.required' => 'Education type field is required',
            'marital_status.required' => 'Marital staus field is required',
            'employment_status.required' => 'Employment status field is required',
            'parent.required' => 'Parent name field is required',
            'parent_phone.required' => 'Parent phone field is required',
            'pdissability.required' => 'Parent dissability field is required',
            'stage.required' => 'Stage field is required'
        ];


        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }   
        
        $user_role = Role::select('role')
        ->join('users', 'roles.id', '=', 'users.role_id')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        if ($user_role->role == 'head of center') {
            $centerId = Center::where('hod_id', Auth::user()->id)->value('id');
        } else {
            $centerId = $request->centerId;
        }

        $centerLocation1 = Region::select('regions.name as rname', 'districts.name as dname')
        ->join('districts', 'districts.region_id', '=', 'regions.id')
        ->join('centers', 'districts.id', '=', 'centers.district_id')
        ->where('centers.id', '=', $request->centerId)
        ->first();
        

        try {
            $this->setCenterLocation();
            $location = $this->center_location;

            $student = Student::find($request->student_id);
            $student->name = $request->name;
            $student->registration_number = $request->reg_no;
            $student->status = $request->status;
            $student->date_of_birth = $request->dob;
            $student->gender = $request->gender;
            $student->nida = $request->nida;
            if ($user_role->role == 'head of center'){
                $student->region = $location->rname;
                $student->district = $location->dname;
            } else{
                $student->region = $centerLocation1->rname;
                $student->district = $centerLocation1->dname;
            } 
            $student->ward = $request->ward;
            $student->stage = $request->stage;
            $student->street = $request->street;
            $student->education_level = $request->education_level;
            $student->education_type = $request->education_type;
            $student->marital_status = $request->marital_status;
            $student->employment_status = $request->employment_status;
            $student->disability = $request->dissability;
            $student->phone_number = $request->phone_number;
            $student->email = $request->student_email;  
           
            $student->save();

            $parent = Guardian::find($request->parent_id);
            $parent->name = $request->parent;
            $parent->phone = $request->parent_phone;
            $parent->email = $request->parent_email;
            $parent->address = $request->parent_address;
            $parent->occupation = $request->parent_occupation;
            $parent->disability = $request->pdissability;
            if ($user_role->role == 'head of center'){
                $parent->region = $location->rname;
                $parent->district = $location->dname;
            } else{
                $parent->region = $centerLocation1->rname;
                $parent->district = $centerLocation1->dname;
            } 
            $parent->ward = $request->pward;
            $parent->save();

            $student_id = $request->student_id;
            if($request->course_id) {
                    StudentCourses::where('student_id', $student_id)->delete();
                    for ($i = 0; $i < sizeof($request->course_id); $i++) {
                        $student_courses = new StudentCourses();
                        $student_courses->student_id = $student_id;
                        $student_courses->course_id = $request->course_id[$i];
                        $student_courses->state = "not complete";
                        // DB::update('update student_courses set course_id = ? where student_id = ?' ,[$request->course_id[$i], $student_id]);
                        $student_courses->save();
                    }
                
            }
            return redirect('students')->with('success', 'User added successfully.');
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function edit($id)
    {
        $student = Student::select('students.*' ,'guardians.phone as phone', 'guardians.id as gid', 'guardians.name as gname', 'guardians.email as gemail', 'guardians.region as gregion',
         'guardians.district as gdistrict', 'guardians.ward as gward', 'guardians.disability as gdissability', 'student_courses.course_id', 'guardians.occupation as occupation',
         'guardians.address as address', 'centers.name as cname')
        ->join('student_courses', 'students.id', '=', 'student_courses.student_id')
        ->join('centers', 'students.center_id', '=', 'centers.id')
        ->join('guardians', 'guardians.student_id', '=', 'students.id')
        ->where('students.id', $id)->first();

        return response()->json(
            [
            'status' => 200,
            'student' => $student
        ]);

    }

    public function delete(Request $request)
    {
        StudentCourses::where('student_id', $request->id)->delete();
        Guardian::where('student_id', '=', $request->id)->delete();
        $student = Student::find($request->id);

        if($student->delete()){
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }

    public function Search()
    {
        $querry = $_GET['search_querry'];
        if ($querry != null) {

            $userData = auth()->user();
        $courses = Course::all();
        $id = $userData->id;
        $userRole = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', $id)
            ->select('roles.role')
            ->first();

        $centers = Center::all();
        $regions = Region::all();
        $students = Student::select('students.id', 'students.disability as disability', 'students.status', 'students.phone_number', 'students.name AS name', 'students.gender', 'students.profile_picture', 'centers.name AS center')
            ->leftJoin('centers', 'students.center_id', '=', 'centers.id')
            ->orderBy('students.created_at','DESC')
            ->paginate(100);
        //for the head of center

        $center1 = Center::select('centers.name AS centerName1', 'centers.id AS id')
            ->where('hod_id', '=', $userData->id)
            ->get();
        $regions = Region::all();
        $students1 = Student::select('students.id AS id', 'students.disability as disability1', 'students.status AS status1', 'students.phone_number AS phone_number1',
         'students.name AS name1', 'students.gender AS gender1', 'courses.name AS course1')
            ->leftJoin('student_courses', 'student_courses.student_id', '=', 'students.id') 
            ->leftJoin('centers', 'students.center_id', '=', 'centers.id')
            ->leftJoin('users', 'users.id', '=', 'hod_id')
            ->leftJoin('courses', 'courses.id', '=', 'student_courses.course_id') 
            ->where('users.id', '=', $userData->id)
            ->where('students.disability', 'LIKE', '%' . $querry . '%')
            ->orWhere('students.status', 'LIKE', '%' . $querry . '%')
            ->orWhere('students.name', 'LIKE', '%' . $querry . '%')
            ->orWhere('students.gender', 'LIKE', '%' . $querry . '%')
            ->orWhere('courses.name', 'LIKE', '%' . $querry . '%')
            ->get();
            
            return view('students.students', ['centers' => $centers, 'center1' => $center1, 'students1' => $students1, 'regions' => $regions, 'students' => $students, 'userData' => $userData, 'userRole' => $userRole, 'courses' => $courses]);
        } else {
            return redirect('students');
        }
    }
}