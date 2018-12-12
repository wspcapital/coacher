<?php

Route::get('webinar-videos/get/{userId}', 'AssetsController@getWebinarVideo')->name('webinar-videos/get');
Route::post('webinar-videos/upload', 'AssetsController@uploadWebinarVideo')->name('webinar-videos/upload');
