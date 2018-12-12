<?php

Route::get('/posts', 'PostController@getAllPosts')->name('posts');
Route::get('/post/new', 'PostController@getNewPost')->name('post/new');
Route::get('/post/{post}', 'PostController@getOnePost')->name('post');
Route::post('/post/create', 'PostController@createPost')->name('post/create');
Route::post('/post/save/{post}', 'PostController@savePost')->name('post/save');
