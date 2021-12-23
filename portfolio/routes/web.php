<?php

use Illuminate\Support\Facades\Route;



// Front End
Route::get('/', 'HomeController@HomeIndex');
Route::post('/ContactSend', 'HomeController@ContactSend');
Route::get('/visitor', 'VisitorController@VisitorIndex')->middleware('loginCheck');
Route::get('/ProjectPage', 'ProjectController@ProjectPage');
Route::get('/ServicePage', 'ServiceController@ServicePage');

// Admin Login
Route::get('/Login', 'LoginController@LoginIndex');
Route::post('/onLogin', 'LoginController@onLogin');
Route::get('/onLogout', 'LoginController@onLogout');


// Back End
Route::get('/admin','DashboardController@DashboardIndex')->middleware('loginCheck');
Route::get('/adminSummary','DashboardHomeController@SummeryIndex')->middleware('loginCheck');

//Admin Panel Service Section
Route::get('/service','Dashboard_ServiceController@ServiceIndex')->middleware('loginCheck');
Route::get('/getServicesData','Dashboard_ServiceController@getServiceData')->middleware('loginCheck');
Route::post('/ServicesDelete','Dashboard_ServiceController@ServiceDelete')->middleware('loginCheck');
Route::post('/ServicesDetails','Dashboard_ServiceController@getServiceDetails')->middleware('loginCheck');
Route::post('/ServicesUpdate','Dashboard_ServiceController@ServiceUpdate')->middleware('loginCheck');
Route::post('/ServicesAdd','Dashboard_ServiceController@ServiceAdd')->middleware('loginCheck');

// Admin Panel Project Section
Route::get('/project','DashboardProjectController@ProjectIndex')->middleware('loginCheck');
Route::get('/getProjectData','DashboardProjectController@getProjectData')->middleware('loginCheck');
Route::post('/ProjectDelete','DashboardProjectController@ProjectDelete')->middleware('loginCheck');
Route::post('/ProjectDetails','DashboardProjectController@getProjectDetails')->middleware('loginCheck');
Route::post('/ProjectUpdate','DashboardProjectController@ProjectUpdate')->middleware('loginCheck');
Route::post('/ProjectAdd','DashboardProjectController@ProjectAdd')->middleware('loginCheck');

// Admin Panel  Photo Section
Route::get('/Photo','PhotoController@PhotoIndex')->middleware('loginCheck');
Route::post('/PhotoUpload','PhotoController@PhotoUpload')->middleware('loginCheck');
Route::get('/PhotoJson','PhotoController@PhotoJson')->middleware('loginCheck');
Route::get('/PhotoJsonById/{id}','PhotoController@PhotoJsonById')->middleware('loginCheck');
Route::post('/PhotoDelete','PhotoController@PhotoDelete')->middleware('loginCheck');

// Admin Panel Contact Section
Route::get('/Contact','DashBoardContactController@ContactIndex')->middleware('loginCheck');
Route::get('/getContactData','DashBoardContactController@getContactData')->middleware('loginCheck');
Route::post('/ContactDelete','DashBoardContactController@ContactDelete')->middleware('loginCheck');