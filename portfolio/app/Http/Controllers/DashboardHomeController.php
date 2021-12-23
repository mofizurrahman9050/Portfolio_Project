<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitorModel;
use App\ProjectModel;
use App\ServiceModel;
use App\ContactModel;

class DashboardHomeController extends Controller
{
    function SummeryIndex(){
        $TotalVisitor= VisitorModel::count();
        $TotalProject= ProjectModel::count();
        $TotalService= ServiceModel::count();
        $TotalContact= ContactModel::count();

        return view('dashboard.dashboard_home',[
            'TotalVisitor'=>$TotalVisitor,
            'TotalProject'=>$TotalProject,
            'TotalService'=>$TotalService,
            'TotalContact'=>$TotalContact
        ]);
    }
}
