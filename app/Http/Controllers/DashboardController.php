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
        $regionDistribution = DashboardController::getRegionDistribution();
        $ageDistribution = DashboardController::getAgeDistribution();
        $coursesDistribution = DashboardController::getCourseDistribution();
        $centersDistribution = DashboardController::getCentersDistribution();

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
        
           
           
        return view('dashboard.dashboard',
            compact(
                'userData',
                'coursesCount',
                'centersCount',
                'studentsCount',
                'teachersCount',
                'regionDistribution',
                'ageDistribution',
                'coursesDistribution',
                'centersDistribution',
                'studentsCount1',
                'coursesCount1',
                'teachersCount1',
                'regionCount',
                'districtCount'
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
                if ($gender === "M") {
                    $row["female"] = $students_count;
                }
                if ($gender == "F") {
                    $row["male"] = $students_count;
                }
                $rows[$region_name] = $row;
            } else {
                $row = $rows[$region_name];
                if ($gender === "M") {
                    $row["female"] = $students_count;
                }
                if ($gender == "F") {
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

//         $user_id = Auth::user()->id;

// $courses = DB::select(
//     "
//     SELECT
//         courses.id,
//         courses.name,
//         count(student_courses.student_id) AS students_count
//     FROM
//         courses
//         INNER JOIN student_courses ON courses.id = student_courses.course_id
//         INNER JOIN course_centers ON courses.id = course_centers.course_id
//         INNER JOIN centers ON course_centers.center_id = centers.id
//     WHERE
//         centers.hod_id = :user_id
//         AND student_courses.center_id = centers.id
//     GROUP BY
//         courses.id,
//         courses.name
//     ",
//     ['user_id' => $user_id]
// );

// return $courses;

        // $user_id = Auth::user()->id;
        

        // $courses = DB::select(
        //     "
        //             SELECT
        //                 courses.id,
        //                 courses.name,
        //                 count(students.id) AS students_count
        //             FROM
        //                 courses
        //                 INNER JOIN student_courses ON courses.id = student_courses.course_id
        //                 INNER JOIN course_centers ON courses.id = course_centers.course_id
        //                 INNER JOIN centers ON course_centers.center_id = centers.id
        //             WHERE
        //                 centers.hod_id = :user_id
        //             GROUP BY
        //                 courses.id,
        //                 courses.name
        //     ",
        //     ['user_id' => $user_id]
        // );
        // $centerId = auth()->user()->id;

        // $courses = DB::table('courses')
        //     ->select('courses.id', 'courses.name', DB::raw('COUNT(DISTINCT students.id) as students_count'))
        //     ->join('course_centers', 'courses.id', '=', 'course_centers.course_id')
        //     ->join('students', 'course_centers.center_id', '=', 'students.center_id')
        //     ->join('student_courses', 'students.id', '=', 'student_courses.student_id')
        //     ->join('centers', 'students.center_id', '=', 'centers.id')
        //     ->where('centers.hod_id', $centerId)
        //     ->groupBy('courses.id', 'courses.name')
        //     ->get();
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
}
