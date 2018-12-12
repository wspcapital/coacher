<?php


Route::get('/coupons', 'CouponController@getCoupon')->name('coupons');
Route::post('/coupons', 'CouponController@postCoupons')->name('coupons');
