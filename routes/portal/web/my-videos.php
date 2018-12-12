<?php


Route::get('/my-videos', 'MyVideosController@getIndex')->name('my-videos');
Route::post('/my-videos/upload', 'MyVideosController@uploadVideo')->name('my-videos/upload');
Route::post('/my-videos/save', 'MyVideosController@save')->name('my-videos/save');
Route::post('/my-videos/updateInfo', 'MyVideosController@updateInfo')->name('my-videos/updateInfo');
