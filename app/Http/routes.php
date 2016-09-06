<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//ALGEMEEN
Route::get('/', function () {
    return view('welcome');
});

//Route::get('/test','HomeController@test');

Route::get('/detectie/registreer', 'HomeController@detectieRegistreer');
Route::get('/detectie/registreer/success', 'HomeController@detectieRegistreerSuccess');


//ADMIN
Route::get('/admin', 'HomeController@admin')->middleware('auth');
Route::get('/admin/detectie', 'HomeController@detectie')->middleware('auth');
Route::get('admin/detectie/deelnemers', 'HomeController@detectieDeelnemers')->middleware('auth');
Route::get('admin/detectie/toewijzen', 'HomeController@detectieToewijzen')->middleware('auth');


//Route::get('/admin/activity', 'HomeController@activity');

// FILE UPLOAD
Route::post('apply/upload', 'HomeController@upload')->middleware('auth');
	
////GET
/*
Path: /api/v1/private/activiteit/

Type: private

Description:
Gets back the activities with a specific id

Parameters:
activiteitId - path - Returns activities with the this id

Response:
200 - Alle variables from v_activiteis
412 - status & message

*/
/**
ACTIVITY
*/
// PUBLIC
Route::get('/api/v1/public/activity/{activityId?}', 
	'ActivityController@showActivity');

// PRIVATE 
Route::post('/api/v1/private/activity',
	[	'middleware' => 'auth',
	'uses' => 'ActivityController@writeActivity']);



/**
ACTIVITY PERSON
*/

// PRIVATE
Route::post('/api/v1/private/activity/{activityIds?}/person',
	[	'middleware' => 'auth',
	'uses' => 'ActivityController@writeActivityPerson']);

Route::get('/api/v1/private/activity/{activityIds?}/person',
	[	'middleware' => 'auth',
	'uses' => 'ActivityController@readActivityPerson']);

Route::put('/api/v1/private/activity/{activityId}/person/{persoonId}',
	[	'middleware' => 'auth',
	'uses' => 'ActivityController@updateActivityPerson']);

Route::get('/api/v1/private/{tokenId}/activity/{activityIds}/person',
	[	'uses' => 'ActivityController@readActivityPersonToken']);

Route::put('/api/v1/private/{tokenId}/activity/{activityId}/person/{persoonId}', 'ActivityController@updateActivityPersonToken');

/**
PERSON
*/
// PRIVATE TOKEN
Route::get('/api/v1/private/{tokenId}/person',
	['uses' => 'PersonController@getPerson']);

// PRIVATE
Route::get('/api/v1/private/person',
	[	'middleware' => 'auth',
	'uses' => 'PersonController@getPerson1']);

Route::post('/api/v1/private/person',
	[	'middleware' => 'auth',
	'uses' => 'PersonController@writePerson']);

Route::put('/api/v1/private/person/{personId}',
	[	'middleware' => 'auth',
	'uses' => 'PersonController@updatePerson1']);

Route::put('/api/v1/private/{tokenId}/person/{personId}',
	[	'uses' => 'PersonController@updatePerson']);


/**
VVB LOOKUP
*/
Route::get('/api/v1/private/vvbLid',
	[	'middleware' => 'auth',
	'uses' => 'PersonController@showVvbLid']);






Route::auth();


//Route::get('/home', 'HomeController@index');
