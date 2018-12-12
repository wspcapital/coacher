<?php

Route::get('/orders', 'OrderController@getAllOrders')->name('orders');
Route::get('/order/new', 'OrderController@getNewOrder')->name('order/new');
Route::get('/order/{order}', 'OrderController@getOneOrder')->name('order');
Route::post('/order/create', 'OrderController@createOrder')->name('order/create');
Route::post('/order/videoSave/{order}', 'OrderController@saveVideoOrder')->name('order/videoSave');
Route::post('/order/sessionSave/{order}', 'OrderController@saveSessionOrder')->name('order/sessionSave');
