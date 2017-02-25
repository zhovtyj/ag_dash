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
    Route::get('client/{client_id}/service/{service_id}', ['uses' => 'ServiceController@show', 'as' => 'agency.service.show']);

    //Cart
    Route::get('/cart/{client_id}', ['uses' => 'CartController@index', 'as' => 'cart.index' ]);
    Route::delete('/cart/{client_id}/{id}', ['uses' => 'CartController@destroy', 'as' => 'cart.destroy' ]);

    //Add to cart Ajax
    Route::post('/addtocart/{client_id}', ['uses' => 'CartController@addToCartAjax', 'as' => 'agency.addtocart' ]);

    //PayPal
    Route::post('/cart/{client_id}/getCheckout', ['as'=>'getCheckout','uses'=>'PaypalController@getCheckout']);
    Route::get('/cart/{client_id}/getDone', ['as'=>'getDone','uses'=>'PaypalController@getDone']);
    Route::get('/cart/{client_id}/getCancel', ['as'=>'getCancel','uses'=>'PaypalController@getCancel']);

    //Orders
    Route::get('/client/{client_id}/orders', ['uses' => 'OrderController@getClientOrders', 'as' => 'order.orders' ]);
    Route::get('/orders', ['uses' => 'OrderController@index', 'as' => 'order.index' ]);
    Route::get('/orders/pdf-{order_id}', ['uses' => 'OrderController@pdf', 'as' => 'order.pdf' ]);

    //Deposit
    Route::get('/deposit', ['uses' => 'DepositController@index', 'as' => 'deposit.index' ]);
    Route::post('/deposit/depositCheckout', ['uses'=>'DepositController@depositCheckout', 'as'=>'deposit.Checkout']);
    Route::get('/deposit/depositDone', ['uses'=>'DepositController@depositDone', 'as'=>'depositDone']);
    Route::get('/deposit/depositCancel', ['uses'=>'DepositController@depositCancel', 'as'=>'depositCancel']);
    Route::post('/cart/{client_id}/pay-from-deposit', ['uses'=>'DepositController@payFromDeposit', 'as'=>'cart.deposit']);

    //Transaction
    Route::get('/transactions', ['uses'=>'TransactionController@index', 'as'=>'transaction.index']);

    //Edit User Info
    Route::get('/profile', ['uses'=>'UserController@edit', 'as'=>'user.edit']);
    Route::put('/profile/update', ['uses'=>'UserController@update', 'as'=>'user.update']);
    Route::put('/profile/password-update', ['uses'=>'UserController@passwordUpdate', 'as'=>'password.update']);


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