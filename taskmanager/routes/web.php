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

/*
	ROUTE PATTERNS
	--------------
	->where(['year' =>'[0-9]+', 'month' =>'[0-9]+']);
	->where('task','[0-9]+');  
		-> is added in the RouteServiceProvider
*/

/*AUTH */
Auth::routes();
Route::get('/logout','Auth\LoginController@logout');

/*USER*/
Route::put('/user/info','UserController@update');
Route::put('/user/credentials','UserController@changePassword');

/*TASKS*/
Route::get('/task/year/{year}','TaskController@getTaskYears');
Route::get('/task/years','TaskController@getYears');
Route::get('/task/{task}/edit','TaskController@edit');
Route::get('/task/{task}/mark','TaskController@mark');
Route::get('/task/{task}','TaskController@show');
Route::get('/task/create','TaskController@create');
Route::get('/task','TaskController@index');

Route::post('/task','TaskController@store');

Route::put('/task/{task}','TaskController@update');
Route::delete('/task/{task}','TaskController@destroy');

/*TEAMS*/
Route::get('/teams','TeamController@index');

/*SITE*/
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/features','SiteController@features');
Route::get('/faq','SiteController@faq');
Route::get('/','SiteController@index');


