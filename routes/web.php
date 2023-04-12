<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::view('regions','regions.regions');
Route::get('users',[UserController::class,'GetUsers']);
Route::post('/addusers',[UserController::class,'Create'])->name('create_user');
Route::get('updateform/{id}',[UserController::class,'UpdateForm']);
Route::post('updateuser',[UserController::class,'Update'])->name('update_user');


Route::post('/addregions',[RegionsController::class,'Create'])->name('create_region');
Route::get('regions',[RegionsController::class,'GetRegions']);

Route::get('centers',[CenterController::class,'GetCenters']);
Route::post('/addcenter',[CenterController::class,'Create'])->name('create_center');

Route::get('courses',[CourseController::class,'GetCourses']);
Route::post('/addcourse',[CourseController::class,'Create'])->name('create_course');

Route::get('students',[StudentController::class,'GetStudents']);
Route::post('/addstudent',[StudentController::class,'Create'])->name('create_student');

Route::get('dashboard',[DashboardController::class,'GetDashboard']);
Route::get('click_edit/{id}',[CourseController::class,'edit']);
Route::post('/update/{id}',[CourseController::class,'update']);
//Route::view('users','users.users');