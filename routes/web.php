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


Auth::routes();

/****   HomePage *****/
Route::get('/', ['uses' => 'DashboardController@index', 'as' => 'home']);

/****   Agency  *****/
Route::group(['middleware'=>'roles', 'roles'=> ['agency']], function(){

    //Clients
    Route::resource('client', 'ClientController');

    //Service
    Route::get('client/{id}/service', ['uses' => 'ServiceController@index', 'as' => 'service.index']);



});
