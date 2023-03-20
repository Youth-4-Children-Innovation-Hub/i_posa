<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\CenterController;

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

Route::post('/addregions',[RegionsController::class,'Create'])->name('create_region');
Route::get('regions',[RegionsController::class,'GetRegions']);

Route::get('centers',[CenterController::class,'GetCenters']);
Route::post('/addcenter',[CenterController::class,'Create'])->name('create_center');


//Route::view('users','users.users');