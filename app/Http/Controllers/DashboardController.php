<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Center;
use App\Models\Region;
use App\Models\District;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\CourseCenter;
use Faker\Core\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function GetDashboard()
    {
        $userData = Auth::user();
        $coursesCount = Course::all()->count();
        $centersCount = Center::all()->count();
        $studentsCount = Student::all()->count();
        $teachersCount = Teacher::all()->count();
        $regionCount = Region::all()->count();
        $districtCount = District::all()->count();
        $studentReg = DashboardController::studentRegDist();
        $studentCent = DashboardController::studentCenterDist();
        $studentDistrict2 = DashboardController::studentDistrict2();
        $studentCent1 = DashboardController::studentCenterDist1();
        $studentCent2 = DashboardController::studentCenterDist2();
        $regionDistribution = DashboardController::getRegionDistribution();
        $centerGender = DashboardController::centerGenderDist();
        $centerGender1 = DashboardController::centerGenderDist1();
        $centerGender2 = DashboardController::centerGenderDist2();
        $ageDistribution = DashboardController::getAgeDistribution();
        $centerDistrict = DashboardController::centerDistrictDist();
        $centerDistrict1 = DashboardController::centerDistrictDist1();
        $coursesDistribution = DashboardController::getCourseDistribution();
        $centersDistribution = DashboardController::getCentersDistribution();
        
        // head of center statistics
        $studentsCount1 = Student::select('id')
            ->join('centers', 'students.center_id', '=', 'centers.id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->count();

        $coursesCount1 = CourseCenter::select('id')
        ->join('centers', 'course_centers.center_id', '=', 'centers.id')
        ->where('centers.hod_id', '=', Auth::user()->id)
        ->count();

        $teachersCount1 = Teacher::select('id')
        ->where('created_by', '=', Auth::user()->id)
        ->count();
        // end head of center statistics

          // districts statistics
          $studentsCount2 = Student::select('id')
          ->join('centers', 'students.center_id', '=', 'centers.id')
          ->join('districts', 'districts.id', '=', 'centers.district_id')
          ->where('districts.cordinator_id', '=', Auth::user()->id)
          ->count();

            $courseCount2 = CourseCenter::select('id')
            ->join('centers', 'course_centers.center_id', '=', 'centers.id')
            ->join('districts', 'districts.id', '=', 'centers.district_id')
            ->where('districts.cordinator_id', '=', Auth::user()->id)
            ->count();

            $teachersCount2 = Teacher::select('id')
            ->join('centers', 'centers.id', '=', 'teachers.created_by')
            ->join('districts', 'districts.id', '=', 'centers.district_id')
            ->where('districts.cordinator_id', '=', Auth::user()->id)
            ->count();

            $centersCount2 = Center::select('id')
            ->join('districts', 'districts.id', '=', 'centers.district_id')
            ->where('districts.cordinator_id', '=', Auth::user()->id)
            ->count();
            // end districts statistics

             // regions statistics
          $studentsCount3 = Student::select('id')
          ->join('centers', 'students.center_id', '=', 'centers.id')
          ->join('districts', 'districts.id', '=', 'centers.district_id')
          ->join('regions', 'regions.id', '=', 'districts.region_id')
          ->where('regions.cordinator_id', '=', Auth::user()->id)
          ->count();

            $courseCount3 = CourseCenter::select('id')
            ->join('centers', 'course_centers.center_id', '=', 'centers.id')
            ->join('districts', 'districts.id', '=', 'centers.district_id')
            ->join('regions', 'regions.id', '=', 'districts.region_id')
            ->where('regions.cordinator_id', '=', Auth::user()->id)
            ->count();

            $teachersCount3 = Teacher::select('id')
            ->join('centers', 'centers.id', '=', 'teachers.created_by')
            ->join('districts', 'districts.id', '=', 'centers.district_id')
            ->join('regions', 'regions.id', '=', 'districts.region_id')
            ->where('regions.cordinator_id', '=', Auth::user()->id)
            ->count();

            $centersCount3 = Center::select('id')
            ->join('districts', 'districts.id', '=', 'centers.district_id')
            ->join('regions', 'regions.id', '=', 'districts.region_id')
            ->where('regions.cordinator_id', '=', Auth::user()->id)
            ->count();
            // end regions statistics
        
           
           
        return view('dashboard.dashboard',
            compact(
                'userData',
                'coursesCount',
                'courseCount2',
                'courseCount3',
                'centersCount',
                'centersCount2',
                'centersCount3',
                'studentsCount',
                'studentsCount2',
                'studentsCount3',
                'teachersCount',
                'teachersCount2',
                'teachersCount3',
                'regionDistribution',
                'ageDistribution',
                'coursesDistribution',
                'centersDistribution',
                'studentsCount1',
                'coursesCount1',
                'teachersCount1',
                'regionCount',
                'districtCount',
                'centerGender',
                'centerGender1',
                'centerGender2',
                'studentReg',
                'studentCent',
                'studentCent1',
                'studentCent2',
                'studentDistrict2',
                'centerDistrict',
                'centerDistrict1'
            ));
    }

    public static function getRegionDistribution()
    {
        $rows = [];
        $coursesByRegion = DB::select(
            "
                SELECT
                    gender,
                    regions.name AS region_name,
                    count(regions.id) AS students_count
                FROM (
                    SELECT
                        gender,
                        region_id
                    FROM (
                        SELECT
                            students.gender,
                            center_id,
                            district_id
                        FROM
                            students
                        LEFT JOIN centers ON centers.id = students.center_id) AS cst
                    LEFT JOIN districts ON cst.district_id = districts.id) AS cstd
                    LEFT JOIN regions ON cstd.region_id = regions.id
                GROUP BY
                    regions.name,
                    gender
               "
        );
        foreach ($coursesByRegion as $row) {
            $gender = $row->gender;
            $region_name = $row->region_name;
            $students_count = $row->students_count;

            if (!array_key_exists($region_name, $rows)) {
                $row = [];
                $row["region"] = $region_name;
                if ($gender === "F") {
                    $row["female"] = $students_count;
                }
                if ($gender == "M") {
                    $row["male"] = $students_count;
                }
                $rows[$region_name] = $row;
            } else {
                $row = $rows[$region_name];
                if ($gender === "F") {
                    $row["female"] = $students_count;
                }
                if ($gender == "M") {
                    $row["male"] = $students_count;
                }
                $rows[$region_name] = $row;
            }
        }
        $completeRows = [];
        foreach ($rows as $key => $value) {
            $completeRows[] = $value;
        }
        return $completeRows;
    }

    public static function getAgeDistribution()
    {
        $ageDistribution = [];
        $students = Student::all(['date_of_birth', 'id']);
        foreach ($students as $student) {
            $birthDate = $student->date_of_birth;
            $currentDate = new \DateTime();
            $oldDate = new \DateTime($birthDate);
            $interval = $currentDate->diff($oldDate);
            $years = $interval->y;

            if (array_key_exists($years, $ageDistribution)) {
                $ageDistribution[$years] = $ageDistribution[$years] + 1;
            } else {
                $ageDistribution[$years] = 1;
            }
        }

        return $ageDistribution;


    }

    public static function getCourseDistribution(){


        $centerId = auth()->user()->id;

        $courses = DB::table('courses')
            ->select('courses.id', 'courses.name', DB::raw('COUNT(DISTINCT students.id) as students_count'))
            ->join('student_courses', 'courses.id', '=', 'student_courses.course_id')
            ->join('students', 'students.id', '=', 'student_courses.student_id')
            ->join('centers', 'centers.id', '=', 'students.center_id')
            ->where('centers.hod_id', $centerId)
            ->groupBy('courses.id', 'courses.name')
            ->get();
      
        return $courses;

    }

    public static function studentRegDist(){

        $studentReg = DB::table('regions')
            ->select('regions.id', 'regions.name', DB::raw('COUNT(DISTINCT students.id) as students_count'))
            ->join('districts', 'districts.region_id', '=', 'regions.id')
            ->join('centers', 'centers.district_id', '=', 'districts.id')
            ->join('students', 'students.center_id', '=', 'centers.id')
            ->groupBy('regions.id', 'regions.name')
            ->get();
      
        return $studentReg;

    }


    public static function studentCenterDist(){

        $studentCenter = DB::table('centers')
            ->select('centers.id', 'centers.name', DB::raw('COUNT(DISTINCT students.id) as students_count'))
            ->join('students', 'students.center_id', '=', 'centers.id')
            ->groupBy('centers.id', 'centers.name')
            ->get();
      
        return $studentCenter;

    }

    public static function centerDistrictDist(){

        $centerDistrict = DB::table('districts')
            ->select('districts.id', 'districts.name', DB::raw('COUNT(DISTINCT centers.id) as centers_count'))
            ->join('centers', 'centers.district_id', '=', 'districts.id')
            ->groupBy('districts.id', 'districts.name')
            ->get();
      
        return $centerDistrict;

    }

    public static function centerGenderDist(){
        $centerId = auth()->user()->id;

        $studentGenderCounts = DB::table('students')
            ->select(DB::raw('SUM(CASE WHEN gender = "M" THEN 1 ELSE 0 END) as male_count'),
             DB::raw('SUM(CASE WHEN gender = "F" THEN 1 ELSE 0 END) as female_count'))
            ->join('centers', 'centers.id', '=', 'students.center_id')
            ->where('centers.hod_id', $centerId)
            ->first();
        
        return $studentGenderCounts;

    }

    public static function getCentersDistribution(){
        $centers = DB::select("
            SELECT
                rd.id,
                rd.name,
                count(rd.id) AS centers_count
            FROM (
                SELECT
                    districts.id AS district_id,
                    regions.name,
                    regions.id
                FROM
                    regions
                LEFT JOIN districts ON regions.id = districts.region_id) AS rd
                LEFT JOIN centers ON centers.district_id = rd.district_id
            GROUP BY
                rd.id,
                rd.name
        ");
        return $centers;
    }

    // for districts statistics
    public static function studentCenterDist1(){

        $studentCenter1 = DB::table('centers')
            ->select('centers.id', 'centers.name', DB::raw('COUNT(DISTINCT students.id) as students_count'))
            ->join('students', 'students.center_id', '=', 'centers.id')
            ->join('districts', 'districts.id', '=', 'centers.district_id')
            ->where('districts.cordinator_id', '=', auth()->user()->id)
            ->groupBy('centers.id', 'centers.name')
            ->get();
      
        return $studentCenter1;

    }

    public static function centerGenderDist1(){
        $centerId = auth()->user()->id;

        $studentGenderCounts1 = DB::table('students')
            ->select(DB::raw('SUM(CASE WHEN gender = "M" THEN 1 ELSE 0 END) as male_count'),
             DB::raw('SUM(CASE WHEN gender = "F" THEN 1 ELSE 0 END) as female_count'))
            ->join('centers', 'centers.id', '=', 'students.center_id')
            ->join('districts', 'districts.id', '=', 'centers.district_id')
            ->where('districts.cordinator_id', auth()->user()->id)
            ->first();
        
        return $studentGenderCounts1;

    }
    // end districts statistics

     // for region statistics
     public static function centerDistrictDist1(){

        $centerDistrict = DB::table('districts')
            ->select('districts.id', 'districts.name', DB::raw('COUNT(DISTINCT centers.id) as centers_count'))
            ->join('centers', 'centers.district_id', '=', 'districts.id')
            ->join('regions', 'districts.region_id', '=', 'regions.id')
            ->where('regions.cordinator_id', '=', auth()->user()->id)
            ->groupBy('districts.id', 'districts.name')
            ->get();
      
        return $centerDistrict;

    }
     public static function studentCenterDist2(){

        $studentCenter1 = DB::table('centers')
            ->select('centers.id', 'centers.name', DB::raw('COUNT(DISTINCT students.id) as students_count'))
            ->join('students', 'students.center_id', '=', 'centers.id')
            ->join('districts', 'districts.id', '=', 'centers.district_id')
            ->join('regions', 'regions.id', '=', 'districts.region_id')
            ->where('regions.cordinator_id', '=', auth()->user()->id)
            ->groupBy('centers.id', 'centers.name')
            ->get();
      
        return $studentCenter1;

    }

    public static function studentDistrict2(){

        $studentDist2 = DB::table('districts')
            ->select('districts.id', 'districts.name', DB::raw('COUNT(DISTINCT students.id) as students_count'))
            ->join('centers', 'centers.district_id', '=', 'districts.id')
            ->join('students', 'students.center_id', '=', 'centers.id')
            ->join('regions', 'regions.id', '=', 'districts.region_id')
            ->where('regions.cordinator_id', '=', auth()->user()->id)
            ->groupBy('districts.id', 'districts.name')
            ->get();
      
        return $studentDist2;

    }

    public static function centerGenderDist2(){
        $centerId = auth()->user()->id;

        $studentGenderCounts2 = DB::table('students')
            ->select(DB::raw('SUM(CASE WHEN gender = "M" THEN 1 ELSE 0 END) as male_count'),
             DB::raw('SUM(CASE WHEN gender = "F" THEN 1 ELSE 0 END) as female_count'))
            ->join('centers', 'centers.id', '=', 'students.center_id')
            ->join('districts', 'districts.id', '=', 'centers.district_id')
            ->join('regions', 'regions.id', '=', 'districts.region_id')
            ->where('regions.cordinator_id', auth()->user()->id)
            ->first();
        
        return $studentGenderCounts2;

    }
    // end region statistics
}
