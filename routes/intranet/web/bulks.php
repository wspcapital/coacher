<?php


Route::get('/bulks', 'BulkController@getAllBulks')->name('bulks');
Route::get('/bulk/new', 'BulkController@getNewBulk')->name('bulk/new');
Route::get('/bulk/{id}', 'BulkController@getOneBulk')->name('bulk');
Route::post('/bulk/create', 'BulkController@createBulk')->name('bulk/create');
Route::post('/bulk/save', 'BulkController@saveBulk')->name('bulk/save');
