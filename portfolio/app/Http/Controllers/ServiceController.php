<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ServiceModel;

class ServiceController extends Controller
{
    
    function ServicePage(){
        $serviceData=json_decode(ServiceModel::all());

        return view('service',['serviceData'=>$serviceData]);
    }
}
