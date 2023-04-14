<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function GetDashboard(){
        return view('dashboard.dashboard');
    }
}