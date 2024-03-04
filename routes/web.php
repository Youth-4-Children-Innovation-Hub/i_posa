<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\userProfileController;
use App\Http\Controllers\clubController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\DistrictController;
use App\Models\District;
use App\Http\Controllers\TeachersController;
use App\Models\Teacher;
use App\Http\Controllers\reportController;
use App\Models\Report;
use App\Http\Controllers\ForgetPasswordManager;
use App\Models\Newrepport;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelloMail;

//use C:\xampp\htdocs\i_posa\iposa\app\Http\Controllers\UserController.php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('auth/login');
// });
Route::get('/', function () {
    return view('landing');
});

Route::get('log-in', function () {
    return view('auth/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function(){
   
    Route::get('/home', [App\Http\Controllers\DashboardController::class,'GetDashboard'])->name('home');
    //Route::view('regions','regions.regions');
    Route::get('users',[UserController::class,'GetUsers']);
    Route::post('/addusers',[UserController::class,'Create'])->name('create_user');
    Route::get('updateform/{id}',[UserController::class,'UpdateForm']);
    Route::post('updateuser',[UserController::class,'Update'])->name('update_user');
    Route::get('search_user',[UserController::class,'Search']);
    Route::get('edit_user/{id}', [UserController::class, 'edit']);
    Route::post('delete_user', [UserController::class, 'delete'])->name('delete_user');
    
    
    
    Route::post('/addregions',[RegionsController::class,'Create'])->name('create_region');
    Route::get('regions',[RegionsController::class,'GetRegions']);
    Route::get('search_region',[RegionsController::class,'Search']);
    Route::get('edit_region/{id}', [RegionsController::class, 'editRegion']);
    Route::post('edit_region', [RegionsController::class, 'updateRegion'])->name('edit_region');
    Route::post('delete_region', [RegionsController::class, 'delRegion'])->name('delete-region');
    
    
    Route::get('districts',[DistrictController::class,'GetDistricts']);
    Route::post('create_district',[DistrictController::class,'Create'])->name('create_district');
    Route::get('search_district',[DistrictController::class,'Search']);
    Route::get('edit_district/{id}', [DistrictController::class, 'editDistrict']);
    Route::post('update_district', [DistrictController::class, 'updateDistrict'])->name('update_district');
    Route::post('delete_district', [DistrictController::class, 'deleteDistrict'])->name('delete_district');
    
    
    Route::get('centers',[CenterController::class,'GetCenters']);
    Route::post('/addcenter',[CenterController::class,'Create'])->name('create_center');
    Route::get('edit_center/{id}', [CenterController::class, 'edit']);
    Route::post('update_center', [CenterController::class, 'update_center'])->name('update_center');
    Route::post('delete_center', [CenterController::class, 'delete'])->name('delete_center');
    Route::get('search_center',[CenterController::class,'Search']);

    
    Route::get('courses',[CourseController::class,'GetCenterCourses']);
    Route::post('/addcourse',[CourseController::class,'Create'])->name('create_course');
    Route::post('/addnewcourse',[CourseController::class,'CreateNew'])->name('create_new_course');
    Route::get('edit_course/{id}', [CourseController::class, 'editCourse']);
    Route::post('update_course', [CourseController::class, 'updateCourse'])->name('update_course');
    Route::post('delete_course_center', [CourseController::class, 'deleteCourse'])->name('delete_course_center');
    Route::post('delete_course_admin',[CourseController::class,'deleteCourseAdmin'])->name('delete_course_admin');
    Route::get('search_course',[CourseController::class,'Search']);
    
    
    Route::get('teachers',[TeachersController::class,'GetTeachers']);
    Route::post('addteacher',[TeachersController::class,'Create'])->name('create_teacher');
    Route::get('edit_teacher/{id}', [TeachersController::class, 'edit']);
    Route::post('update_teacher', [TeachersController::class, 'update'])->name('update_teacher');
    Route::post('delete_teacher', [TeachersController::class, 'delete'])->name('delete_teacher');
    Route::get('search_teacher',[TeachersController::class,'Search']);

    Route::get('students',[StudentController::class,'GetStudents']);
    Route::post('/addstudent',[StudentController::class,'Create'])->name('create_student');
    Route::get('edit_student/{id}', [StudentController::class, 'edit']);
    Route::post('update_student', [StudentController::class, 'update'])->name('update_student');
    Route::post('delete_student', [StudentController::class, 'delete'])->name('delete_student');
    Route::get('search_student',[StudentController::class,'Search']);

    
    
    Route::get('dashboard',[DashboardController::class,'GetDashboard']);
    Route::get('click_edit/{id}',[CourseController::class,'edit']);
    Route::post('/update/{id}',[CourseController::class,'update']);
    //Route::view('users','users.users');
    
    //Inventory
    Route::get('inventory', [InventoryController::class, 'getInventory'])->name('inventory');
    Route::post('update_inventory', [InventoryController::class, 'update'])->name('update_inventory');
    Route::get('edit_inventory/{id}', [InventoryController::class, 'edit']);
    Route::post('delete_inventory', [InventoryController::class, 'delete'])->name('delete_inventory');
    
    
    Route::get('requestInventory', [InventoryController::class, 'getInventoryRequest']);
    Route::post('/create_inventory_request', [InventoryController::class, 'store'])->name('create_inventory');
    
    Route::get('/user_profile', [userProfileController::class, 'index']);
    Route::post('/edit_profile', [userProfileController::class, 'edit']);
    Route::post('/change_password', [userProfileController::class, 'changePass']);
    Route::post('/change_profile_picture', [userProfileController::class, 'changeProfilePicture']);
    
    Route::get('/reports_page', [reportController::class, 'index']);
    Route::post('/upload_report', [reportController::class, 'upload']);
    Route::get('/download/{file}', [reportController::class, 'download']);
    Route::get('/view/{id}', [reportController::class, 'view']);
    Route::post('delete_report', [reportController::class, 'delete'])->name('delete_report');
    Route::get('/notifications', [reportController::class, 'getNotifications']);
    Route::post('/upload_center_report', [reportController::class, 'uploadCenterReport']);

    Route::post('/send_report', [reportController::class, 'send']);
    Route::post('/approve_report', [reportController::class, 'approve']);
    Route::get('/pdf', [reportController::class, 'getPdf']);
    Route::get('/centerReport', [reportController::class, 'centerReport'])->name('centerReport');
    Route::get('/approve/{id}', [reportController::class, 'approve']);
    Route::post('/remarks', [reportController::class, 'addRemarks'])->name('add_remarks');
    Route::get('/send_mail', [reportController::class, 'sendMail']);

    Route::get('/clubs', [clubController::class, 'getClubs']);
    Route::post('/create_club', [clubController::class, 'createClubs'])->name('create_club');
    Route::get('/club_details/{id}', [clubController::class, 'clubDetails']);

   
    // pdf testing
    Route::get('/ripoti', function () {
        return view('report.centerReport');
    });

});
