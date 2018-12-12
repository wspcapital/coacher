<?php


Route::group(['namespace' => 'Api'], function () {
    Route::get('/applyCoupon', 'CouponController@applyCoupon')->name('applyCoupon');
});
