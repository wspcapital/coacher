<?php


Route::get('learning-videos/get/{userId}', 'AssetsController@getLearningVideo')->name('learning-videos/get');
Route::post('learning-videos/upload', 'AssetsController@uploadLearningVideo')->name('learning-videos/upload');
Route::post('videos/file/upload', 'AssetsController@uploadPdfLearningVideo')->name('videos/file/upload');
