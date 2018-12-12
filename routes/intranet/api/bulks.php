<?php


Route::get('bulks/participants', 'BulkController@getBulkParticipants')->name('bulks/participants');
Route::get('/bulkslist', 'BulkController@getAllBulks')->name('bulkslist');
Route::get('bulks/search', 'BulkController@searchBulks')->name('bulks/search');
Route::get('bulks/delete', 'BulkController@deleteBulk')->name('bulks/delete');
