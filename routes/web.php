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

    //PayPal Subscription
    Route::post('/cart/{client_id}/payPalSubsription', ['uses'=>'PaypalController@subscription', 'as'=>'paypal.subscribe']);
    Route::get('/cart/{client_id}/payPalSubsriptionDone', ['uses'=>'PaypalController@getSubscriptionDone', 'as'=>'paypal.subscribe.done']);
    Route::get('/cart/{client_id}/payPalSubsriptionCancel', ['uses'=>'PaypalController@getSubscriptionCancel', 'as'=>'paypal.subscribe.cancel']);

    //Orders
    Route::get('/client/{client_id}/orders', ['uses' => 'OrderController@getClientOrders', 'as' => 'order.orders' ]);
    Route::get('/orders', ['uses' => 'OrderController@index', 'as' => 'order.index' ]);

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

    //MESSAGES
    Route::get('/messages', ['uses'=>'MessagesController@index', 'as'=>'messages.index']);

});


/****   ADMIN  *****/
Route::group(['middleware'=>'roles', 'roles'=> ['admin']], function(){

    //ADMIN
    Route::get('/admin', ['uses' => 'Admin\AdminController@index', 'as' => 'admin.index']);

    //SERVICES
    Route::resource('admin/service', 'Admin\ServiceController');
    //OPTIONAL SERVICES
    Route::resource('admin/service-optional', 'Admin\ServiceOptionalController');

    //USERS
    Route::get('admin/agency', ['uses' => 'Admin\UserController@index', 'as' => 'admin.user']);

    //CLIENTS
    Route::get('admin/agency/{agency_id}/clients', ['uses'=>'Admin\ClientController@index', 'as'=>'admin.client']);
    Route::get('admin/agency/{agency_id}/clients/create', ['uses'=>'Admin\ClientController@create', 'as'=>'admin.client.create']);
    Route::post('admin/agency/{agency_id}/clients', ['uses'=>'Admin\ClientController@store', 'as'=>'admin.client.store']);
    Route::get('admin/agency/{agency_id}/clients/{client_id}', ['uses'=>'Admin\ClientController@show', 'as'=>'admin.client.show']);
    Route::get('admin/agency/{agency_id}/clients/{client_id}/edit', ['uses'=>'Admin\ClientController@edit', 'as'=>'admin.client.edit']);
    Route::put('admin/agency/{agency_id}/clients/{client_id}', ['uses'=>'Admin\ClientController@update', 'as'=>'admin.client.update']);
    Route::delete('admin/agency/{agency_id}/clients/{client_id}', ['uses'=>'Admin\ClientController@destroy', 'as'=>'admin.client.destroy']);

    //ORDERS
    Route::get('admin/agency/{agency_id}/orders', ['uses'=> 'Admin\OrderController@agency', 'as'=>'admin.order.agency']);

    //TRANSACTIONS
    Route::get('admin/agency/{agency_id}/transactions', ['uses'=> 'Admin\TransactionController@agency', 'as'=>'admin.transaction.agency']);

    //MESSAGES
    Route::get('/admin/messages/{agency_id}', ['uses'=>'Admin\MessagesController@index', 'as'=>'admin.messages.index']);

});

/****   AUTH USERS  *****/
Route::group(['middleware'=>'auth'], function(){

    //MESSAGES
    Route::get('/admin/messages/{agency_id}/all', ['uses'=>'Admin\MessagesController@messages', 'as'=>'admin.messages.all']);
    Route::post('/admin/messages/{agency_id}', ['uses'=>'Admin\MessagesController@store', 'as'=>'admin.messages.store']);
    Route::post('/messages/file-upload/{agency_id}', ['uses'=>'Admin\MessagesController@fileUpload', 'as'=>'messages.fileupload']);
});
//Orders PDF availible for All
Route::get('/orders/pdf-{order_id}', ['uses' => 'OrderController@pdf', 'as' => 'order.pdf' ]);