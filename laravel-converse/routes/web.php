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


Route::get('/', 'ChatController@index');
Route::get('/home', 'ChatController@index');
Route::get('/dashboard', 'DashboardController@index');


Route::get('/chat', 'ChatController@index');
Route::get('/chat/{chat_id}', 'ChatController@show');
Route::post('/chat_post/{chat_id}', 'ChatController@store_wpp');
Route::get('/chat/store', 'ChatController@store');
Route::post('/chat/store', 'ChatController@store');
Route::post('/wpp_receive', 'ChatController@wpp_receive');
Route::get('/server_chats', 'ChatController@server_chats');
Route::get('/server/{chat_id}', 'ChatController@server');
Route::post('/server/{chat_id}', 'ChatController@server');
Route::get('/chat/history/{chat_id}', 'ChatController@history');

Route::get('/ajax', function(){
	return  view('chat.message');
});
Route::get('/getmsg', 'MessagesController@index');
//Por algum motivo nãoe stá dando certo enviar por post
//Route::post('/getmsg', 'MessagesController@index');



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
