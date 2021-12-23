<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ProjectModel;

class ProjectController extends Controller
{
    
    function ProjectPage(){
        $projectData=json_decode(ProjectModel::orderBy('id','desc')->get());

        return view('project',['projectData'=>$projectData]);
    }
}
