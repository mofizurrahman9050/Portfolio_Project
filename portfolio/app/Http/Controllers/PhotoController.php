<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\PhotoModel;

class PhotoController extends Controller
{

    function PhotoIndex(){
        return view('dashboard.dashboard_photo');
    }

    function PhotoJson(){
        return PhotoModel::take(4)->get();
    }

    function PhotoDelete(Request $request){
        $OldPhotoURL=$request->input('OldPhotoURL');
        $OldPhotoID=$request->input('id');        

        $OldPhotoURLArray= explode("/",$OldPhotoURL);
        $OldPhotoName=end($OldPhotoURLArray);
        $DeletePhotoFile=Storage::delete('public/',$OldPhotoName);

        $DeleteRow= PhotoModel::where('id','=',$OldPhotoID)->delete();
        
        if($DeleteRow==1){
            return 1;
        }else{
            return 0;
        }

    }


    function PhotoJsonById(Request $request){
       $FirstId=$request->id;
       $LastId= $FirstId+4;

       return PhotoModel::where('id','>=', $FirstId)->where('id','<',$LastId)->get();
    }


    function PhotoUpload(Request $request){
        $PhotoPath= $request->file('photo')->store('public');

        $PhotoName=(explode('/',$PhotoPath))[1];
        $host=$_SERVER['HTTP_HOST'];
        $location="http://".$host."/storage/".$PhotoName;

       $result= PhotoModel::insert(['location'=>$location]);

        return $result;
    }
}
