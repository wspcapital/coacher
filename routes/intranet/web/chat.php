<?php


Route::get('/chat/{id}', 'ChatController@getIntranetChat')->name('intranet-chat');
Route::post('/message/save', 'ChatController@saveIntranetMessage')->name('intranet-message-save');
