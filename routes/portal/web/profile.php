<?php


Route::get('/profile', 'ProfileController@getIndex')->name('profile');
Route::post('/profile/save', 'ProfileController@saveUser')->name('profile/save');
