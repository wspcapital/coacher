<?php

Route::get('/users', 'UserController@getAllUsers')->name('users');
Route::get('/user/new', 'UserController@getNewUser')->name('user/new');
Route::get('/user/{user}', 'UserController@getOneUser')->name('user');
Route::post('/user/save/{user}', 'UserController@saveUser')->name('user/save');
Route::post('/user/create', 'UserController@addUser')->name('user/create');
Route::get('/user/delete/{user}', 'UserController@deleteUser')->name('user/delete');
Route::get('/user/debug/{user}', 'UserController@debug')->name('user/debug');
Route::get('/profile', 'UserController@getProfile')->name('profile');
