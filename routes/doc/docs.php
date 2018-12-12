<?php


Route::get('/docs/ina/{share_hash}', 'DocController@getIna');
Route::post('/docs/ina/{share_hash}', 'DocController@saveIna');

Route::get('/docs/logistics/{share_hash}', 'DocController@getLogistics');
Route::post('/docs/logistics/{share_hash}', 'DocController@saveLogistics');
