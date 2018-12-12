<?php

Route::get('/virtual-coach', 'VCoachController@getIndex')->name('virtual-coach');
Route::post('/addSession', 'VCoachController@addSession')->name('addSession');
Route::post('/updateSession', 'VCoachController@updateSession')->name('updateSession');
