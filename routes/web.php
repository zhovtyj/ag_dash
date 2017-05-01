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
    Route::get('/services', ['uses' => 'ServiceController@services', 'as' => 'agency.service.services']);
    Route::get('client/{client_id}/service', ['uses' => 'ServiceController@index', 'as' => 'agency.service.index']);
    Route::get('client/{client_id}/service/{service_id}', ['uses' => 'ServiceController@show', 'as' => 'agency.service.show']);
    Route::post('/change-client', ['uses'=>'ServiceController@changeClient', 'as'=>'service.change.client']);

    //Cart
    Route::get('/cart/{client_id}', ['uses' => 'CartController@index', 'as' => 'cart.index' ]);
    Route::delete('/cart/{client_id}/{id}', ['uses' => 'CartController@destroy', 'as' => 'cart.destroy' ]);

    //Coupon
    Route::post('/cart/check-coupon', ['uses' => 'CartController@checkCoupon', 'as'=> 'cart.check-coupon']);

    //Add to cart Ajax
    Route::post('/addtocart/{client_id}', ['uses' => 'CartController@addToCartAjax', 'as' => 'agency.addtocart' ]);

    //PayPal
    Route::post('/cart/{client_id}/getCheckout', ['as'=>'getCheckout','uses'=>'PaypalController@getCheckout']);
    Route::get('/cart/{client_id}/{order_id}/getDone', ['as'=>'getDone','uses'=>'PaypalController@getDone']);
    Route::get('/cart/{client_id}/{order_id}/getCancel', ['as'=>'getCancel','uses'=>'PaypalController@getCancel']);

    //PayPal Subscription
    Route::post('/cart/{client_id}/payPalSubsription', ['uses'=>'PaypalController@subscription', 'as'=>'paypal.subscribe']);
    Route::get('/cart/{subscription_id}/payPalSubsriptionDone', ['uses'=>'PaypalController@getSubscriptionDone', 'as'=>'paypal.subscribe.done']);
    Route::get('/cart/{subscription_id}/payPalSubsriptionCancel', ['uses'=>'PaypalController@getSubscriptionCancel', 'as'=>'paypal.subscribe.cancel']);

    //Orders
    Route::get('/client/{client_id}/orders', ['uses' => 'OrderController@getClientOrders', 'as' => 'order.orders' ]);
    Route::get('/orders', ['uses' => 'OrderController@index', 'as' => 'order.index' ]);

    //Subscription Orders
    Route::get('/subscriptions', ['uses'=>'SubscriptionController@index', 'as'=>'subscription.index']);
    Route::get('/client/{client_id}/orders/subscriptions', ['uses'=>'SubscriptionController@getClientSubscriptions', 'as'=>'subscription.client']);

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
    Route::post('/messages-count', ['uses'=>'MessagesController@newMessagesCount', 'as'=>'messages.count']);

    //MANAGE ACCOUNTS
    Route::get('/manage-accounts', ['uses'=>'ManageAccountsController@index', 'as'=>'manage-accounts']);
    Route::post('/manage-accounts/notes-store', ['uses'=>'ManageAccountsController@notesStore', 'as'=>'manage-accounts.notes-store']);
    Route::post('/manage-accounts/client', ['uses'=>'ManageAccountsController@clientAjax', 'as'=>'manage-accounts.client-ajax']);
    Route::post('/manage-accounts/tags-store', ['uses'=>'ManageAccountsController@tagsStore', 'as'=>'manage-accounts.tags-store']);

});


/****   ADMIN  *****/
Route::group(['middleware'=>'roles', 'roles'=> ['admin']], function(){

    //ADMIN
    Route::get('/admin', ['uses' => 'Admin\AdminController@index', 'as' => 'admin.index']);

    //SERVICES
    Route::resource('admin/service', 'Admin\ServiceController');

    //CATEGORIES
    Route::resource('admin/categories', 'Admin\CategoryController');

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
    //Agency orders
    Route::get('admin/agency/{agency_id}/orders', ['uses'=> 'Admin\OrderController@agency', 'as'=>'admin.order.agency']);
    Route::get('admin/agency/{agency_id}/orders/new', ['uses'=> 'Admin\OrderController@agencyNewOrders', 'as'=>'admin.order.agency.new']);
    Route::get('admin/agency/{agency_id}/orders/active', ['uses'=> 'Admin\OrderController@agencyActiveOrders', 'as'=>'admin.order.agency.active']);
    Route::get('admin/agency/{agency_id}/orders/completed', ['uses'=> 'Admin\OrderController@agencyCompletedOrders', 'as'=>'admin.order.agency.completed']);
    //All orders by group
    Route::get('admin/orders/all', ['uses'=>'Admin\OrderController@orders', 'as'=>'admin.orders.all']);
    Route::get('admin/orders/new', ['uses'=>'Admin\OrderController@newOrders', 'as'=>'admin.orders.new']);
    Route::get('admin/orders/active', ['uses'=>'Admin\OrderController@activeOrders', 'as'=>'admin.orders.active']);
    Route::get('admin/orders/completed', ['uses'=>'Admin\OrderController@completedOrders', 'as'=>'admin.orders.completed']);
    //Ajax update status
    Route::post('admin/orders/change-status', ['uses'=>'Admin\OrderController@changeStatus', 'as'=>'admin.orders.change.status']);
    //Count new Orders
    Route::post('/admin/orders-count', ['uses'=>'Admin\OrderController@newOrdersCount', 'as'=>'admin.orders.count']);

    //Subscriptions
    //Agency Subscriptions
    Route::get('admin/agency/{agency_id}/subscriptions', ['uses'=> 'Admin\SubscriptionController@agency', 'as'=>'admin.subscription.agency']);
    Route::get('admin/agency/{agency_id}/subscriptions/new', ['uses'=> 'Admin\SubscriptionController@agencyNewSubscriptions', 'as'=>'admin.subscription.agency.new']);
    Route::get('admin/agency/{agency_id}/subscriptions/active', ['uses'=> 'Admin\SubscriptionController@agencyActiveSubscriptions', 'as'=>'admin.subscription.agency.active']);
    Route::get('admin/agency/{agency_id}/subscriptions/completed', ['uses'=> 'Admin\SubscriptionController@agencyCompletedSubscriptions', 'as'=>'admin.subscription.agency.completed']);
    //All Subscriptions by Group
    Route::get('admin/subscriptions/all', ['uses'=>'Admin\SubscriptionController@subscriptions', 'as'=>'admin.subscriptions.all']);
    Route::get('admin/subscriptions/new', ['uses'=>'Admin\SubscriptionController@newsubscriptions', 'as'=>'admin.subscriptions.new']);
    Route::get('admin/subscriptions/active', ['uses'=>'Admin\SubscriptionController@activesubscriptions', 'as'=>'admin.subscriptions.active']);
    Route::get('admin/subscriptions/completed', ['uses'=>'Admin\SubscriptionController@completedsubscriptions', 'as'=>'admin.subscriptions.completed']);
    //Ajax update status
    Route::post('admin/subscriptions/change-status', ['uses'=>'Admin\SubscriptionController@changeStatus', 'as'=>'admin.subscriptions.change.status']);
    //Count new Subscriptions
    Route::post('/admin/subscriptions-count', ['uses'=>'Admin\SubscriptionController@newSubscriptionsCount', 'as'=>'admin.subscriptions.count']);

    //COUPONS
    Route::resource('admin/coupons', 'Admin\CouponController');

    //TRANSACTIONS
    Route::get('admin/agency/{agency_id}/transactions', ['uses'=> 'Admin\TransactionController@agency', 'as'=>'admin.transaction.agency']);

    //MESSAGES
    Route::get('/admin/messages/all', ['uses'=>'Admin\MessagesController@threads', 'as'=>'admin.messages.threads']);
    Route::get('/admin/messages/{agency_id}', ['uses'=>'Admin\MessagesController@index', 'as'=>'admin.messages.index']);
    Route::post('/admin/messages-count', ['uses'=>'Admin\MessagesController@newMessagesCount', 'as'=>'admin.messages.count']);

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
Route::get('/subscriptions/pdf-{subscription_id}', ['uses' => 'SubscriptionController@pdf', 'as' => 'subscription.pdf' ]);