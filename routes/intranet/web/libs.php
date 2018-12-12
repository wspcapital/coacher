<?php

Route::get('/libs', 'LibController@getLibs')->name('libs');
Route::get('/lib/new/{category_id?}', 'LibController@getNewLib')->name('lib/new');
Route::get('/lib/{lib}', 'LibController@getOneLib')->name('lib');
Route::post('/lib/create', 'LibController@createLib')->name('lib/create');
Route::post('/lib/save', 'LibController@saveLib')->name('lib/save');

Route::get('/libs/category/new/{category_id?}', 'LibController@getNewCategoryLibs')->name('libs/category/new');
Route::get('/libs/category/{id}', 'LibController@getChildrenCategoryLibs')->name('libs/category');
Route::post('/lib/category/create', 'LibController@createLibCategory')->name('lib/category/create');
Route::post('/lib/category/save', 'LibController@saveLibCategory')->name('lib/category/save');
Route::post('/lib/upload-file', 'LibController@uploadLibFile')->name('lib/upload-file');
Route::get('/libs/search/{keyword}', 'LibController@searchLibs')->name('libs/search');
