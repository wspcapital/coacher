<?php

Route::any('/', 'BookingController@getAllBookings')->name('intranet');
Route::get('/booking/new', 'BookingController@getNewBooking')->name('booking/new');
Route::get('/booking/{id}', 'BookingController@getOneBooking')->name('booking');
Route::get('/booking/save-as/{oldBooking}', 'BookingController@saveAsBooking')->name('booking/save-as');
Route::post('/booking/create', 'BookingController@createBooking')->name('booking/create');
Route::post('/booking/save', 'BookingController@saveBooking')->name('booking/save');

