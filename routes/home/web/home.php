<?php

Route::get('/', 'HomeController@getIndex')->name('/');
Route::get('/company', 'HomeController@getCompany')->name('company');
Route::get('/services', 'HomeController@getServices')->name('services');
Route::get('/how-are-we-different', 'HomeController@getDifferent')->name('how-are-we-different');
Route::get('/events', 'HomeController@getEvent')->name('events');
Route::get('/contact', 'HomeController@getContact')->name('contact');
Route::post('/contact', 'HomeController@postContact')->name('contact');
