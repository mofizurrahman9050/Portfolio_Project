<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function DashboardIndex(){

        return view('dashboard.dashboard_home');
    }

}
