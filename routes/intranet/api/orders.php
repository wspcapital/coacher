<?php


Route::get('/allOrders/{sortKey?}/{sortType?}', 'OrderController@getAllOrders')->name('allOrders');
Route::post('/orders/trainer/save/{order}', 'OrderController@saveTrainer')->name('orders/trainer/save');
Route::get('orders/search', 'OrderController@searchOrder')->name('orders/search');
Route::get('orders/delete', 'OrderController@deleteOrder')->name('orders/delete');
