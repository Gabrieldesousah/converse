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


Route::get('/', 'WelcomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/dashboard', 'DashboardController@index');


Route::get('/chat', 'ChatController@index');
Route::get('/chat/{chat_id}', 'ChatController@show');
Route::post('/chat/{chat_id}', 'ChatController@store');
Route::get('/chat/store', 'ChatController@store');
Route::post('/chat/store', 'ChatController@store');
Route::get('/chat/server', 'ChatController@server');
Route::post('/chat/server', 'ChatController@server');
Route::get('/chat/history/{chat_id}', 'ChatController@history');



//Users
Route::get('/users', 'UsersController@index');
Route::get('/user/{id}', 'UsersController@show');
Route::get('/users/search', 'UsersController@search');
Route::get('/editprofile/{user?}', 'UsersController@edit');
Route::get('/editpass/{user?}', 'UsersController@editpass');
Route::post('/updateprofile/{user?}', 'UsersController@updateProfile');
Route::post('/updatepass/{user?}', 'UsersController@updatePass');

Route::get('/actions', 'ActionsController@index');
Auth::routes();


//Contents
Route::get('/contents', 'ContentsController@index');
Route::get('/contents/{name}', 'ContentsController@show');
//Route::get('/selectInMass', 'ContentsController@selectInMass');
//Route::post('/contentsInMass', 'ContentsController@createInMass');

//Professors
//Route::get('/selectInMass', 'ProfessorsController@selectInMass');
//Route::post('/professorsInMass', 'ProfessorsController@createInMass');

//Materials
Route::get('/material/{material}', 'MaterialsController@show');
Route::get('/materials/share', 'MaterialsController@create');
Route::post('/materials/store', 'MaterialsController@store');
Route::get('/material/edit/{material}', 'MaterialsController@edit');
Route::post('/material/update', 'MaterialsController@update');
Route::get('/material/destroy/{material}', 'MaterialsController@destroy');

//Comments
Route::post('/comments/store', 'CommentsController@store');
Route::get('/comments/edit/{comment}', 'CommentsController@edit');
Route::post('/comments/update', 'CommentsController@update');
Route::get('/comments/destroy/{comment}', 'CommentsController@destroy');

//Search
Route::get('/search/key', 'SearchController@key');

Route::get('/searches', 'SearchController@index');

//File
Route::get('/file/{material}', 'MaterialsController@show_file');
Route::get('/file/{material}/{file}', 'MaterialsController@show_file');


/*

### Optional Parameters

Occasionally you may need to specify a route parameter, but make the presence of that route parameter optional. You may do so by placing a `?` mark after the parameter name. Make sure to give the route's corresponding variable a default value:

    Route::get('user/{name?}', function ($name = null) {
        return $name;
    });

    Route::get('user/{name?}', function ($name = 'John') {
        return $name;
    });
*/

/*Route::get('/login/{Redirect_Controller}/{Redirect_Action?}/{Redirect_Id?}', 
	function($Redirect_Controller = null, 
		$Redirect_Action = null, 
		$Redirect_Id = null)
	{
		return view('auth.login', [
			'Redirect_Controller' => $Redirect_Controller, 
			'Redirect_Action' => $Redirect_Action, 
			'Redirect_Id' => $Redirect_Id
			]);
	});
*/