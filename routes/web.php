<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//patients

Route::get('/patients', 'PatientsController@patients');
Route::get('/getPatients', 'PatientsController@get');
Route::post('/savePatient','PatientsController@save');
Route::get('/getSinglePatient/{id}', 'PatientsController@getSingle');
Route::get('/deletePatient/{patient_id}', 'PatientsController@delete');
Route::post('/updatePatient', 'PatientsController@update');

//services
Route::get('/services', 'ServiceController@services');
Route::get('/getServices', 'ServiceController@get');
Route::post('/saveService','ServiceController@save');
Route::get('/getSingleService/{id}', 'ServiceController@getSingle');
Route::get('/deleteService/{service_id}', 'ServiceController@delete');
Route::post('/updateService', 'ServiceController@update');

//visits
Route::post('/saveVisit','VisitController@save');
Route::get('/visits', 'VisitController@visits');
Route::get('/getVisits', 'VisitController@get');
Route::get('/getSingleVisit/{id}', 'VisitController@getSingle');
Route::get('/deleteVisit/{Visit_id}', 'VisitController@delete');
Route::post('/updateVisit', 'VisitController@update');
Route::get('/map','VisitController@map');

//api
Route::get('/','PatientsController@webservice');
Route::get('/webservice','PatientsController@webservice');
Route::post('/authenticate','PatientsController@authenticate');

Route::get('/business','BusinessController@business');
Route::get('/tesJson','BusinessController@tesJson');
Route::get('/infomoby/.$keyword."/".$location."/".$lat."/".$lng."/0/16"','KaizalaController@infomoby');

