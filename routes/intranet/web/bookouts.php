<?php


Route::get('/bookouts', 'BookingController@getAllBookouts')->name('bookouts');
Route::get('/bookout/{id}', 'BookingController@getOneBookout')->name('bookout');
Route::post('/bookout/create', 'BookingController@createBookout')->name('bookout/create');
Route::post('/bookout/save', 'BookingController@saveBookout')->name('bookout/save');
