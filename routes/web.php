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

/****   AGENCY  *****/
Route::group(['middleware'=>'roles', 'roles'=> ['agency']], function(){

    //Clients
    Route::resource('client', 'ClientController');

    //Service
    Route::get('client/{client_id}/service', ['uses' => 'ServiceController@index', 'as' => 'agency.service.index']);
    Route::get('client/service/{service_id}', ['uses' => 'ServiceController@show', 'as' => 'agency.service.show']);

    //Cart
    Route::get('/cart/{client_id}', ['uses' => 'CartController@index', 'as' => 'cart.index' ]);
    Route::delete('/cart/{client_id}/{id}', ['uses' => 'CartController@destroy', 'as' => 'cart.destroy' ]);

    //Add to cart Ajax
    Route::post('/addtocart/{client_id}', ['uses' => 'CartController@addToCartAjax', 'as' => 'agency.addtocart' ]);



});


/****   ADMIN  *****/
Route::group(['middleware'=>'roles', 'roles'=> ['admin']], function(){

    //ADMIN
    Route::get('/admin', ['uses' => 'Admin\AdminController@index', 'as' => 'admin.index']);

    //SERVICES
    Route::resource('admin/service', 'Admin\ServiceController');
    //OPTIONAL SERVICES
    Route::resource('admin/service-optional', 'Admin\ServiceOptionalController');


});