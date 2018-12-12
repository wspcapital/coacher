<?php


Route::get('/user/blocked/{user}', 'UserController@blockUser')->name('blockUser');
Route::get('/users/search', 'UserController@searchUsers')->name('users/search');
Route::get('/userlist', 'UserController@getAllUsers')->name('userlist');
Route::get('/user-event/send-account/{user}', 'UserController@sendAccount')->name('user-event/send-account');
Route::get('/user-event/send-email/{user}', 'UserController@sendEmail')->name('user-event/send-email');
