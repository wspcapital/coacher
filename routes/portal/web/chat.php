<?php


Route::get('/chat', 'ChatController@getPortalChat')->name('portal-chat');
Route::post('/message/save', 'ChatController@savePortalMessage')->name('portal-message-save');
