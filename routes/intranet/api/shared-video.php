<?php

Route::get('get-shared-video', 'SharedVideoController@getSharedVideo')->name('get-shared-video');
Route::post('add-participant/{type}', 'SharedVideoController@addParticipant')->name('add-participant');
Route::post('del-participant', 'SharedVideoController@deleteParticipant')->name('del-participant');
