<?php


Route::get('workshop-videos/get/{userId}', 'AssetsController@getWorkshopVideo')->name('workshop-videos/get');
Route::post('workshop-videos/upload', 'AssetsController@uploadWorkshopVideo')->name('workshop-videos/upload');
Route::get('videos/delete/{id}', 'AssetsController@deleteVideo')->name('videos/delete');
Route::post('workshop-videos/save', 'AssetsController@saveInfoVideo')->name('workshop-videos/save');
