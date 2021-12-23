<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitorModel;

class VisitorController extends Controller
{
      function VisitorIndex(){
       $VisitorData= json_decode(VisitorModel::orderBy('id','desc')->take(500)->get());
       
        return view('dashboard.dashboard_visitor',['VisitorData'=>$VisitorData]);
    }
}
