<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Auth::routes();


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

/*
 * routes homepage
 */
Route::group(['namespace' => 'User'], function () {
    include('home/web/home.php');
    include('vcoach/web/vcoach.php');
});

Route::group(['namespace' => 'Api'], function () {
    include('vcoach/api/vcoach.php');
});

/*
 * routes intranet
 */
Route::group(['middleware' => ['auth', 'permission:intranet-read']], function () {
    Route::group(['prefix' => 'intranet'], function () {
        include('intranet/web/intranet.php');
        include('intranet/api/intranet.php');
    });
});

/*
 * routes portal
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'portal'], function () {
        include 'portal/web/portal.php';
        include 'portal/api/coupon.php';
    });
});

include('payments/payments.php');
include('doc/docs.php');

Route::get('/test', 'TestController@getIndex');
Route::get('/expert', 'TestController@getExpert');

Route::get('/chat/check-auth', 'BaseChatController@checkAuth');
