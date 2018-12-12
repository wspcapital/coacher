<?php


Route::group(['prefix' => 'bookings'], function () {

    Route::get('curriculum/events/{bookingId}', 'BookingController@getEvents')->name('curriculum/events');
    Route::get('curriculum/event/delete', 'BookingController@deleteEvent')->name('curriculum/event/delete');
    Route::get('getFile', 'BookingController@getBookingFile')->name('getFile');
    Route::get('deleteFile/{id}', 'BookingController@deleteBookingFile')->name('deleteFile');
    Route::get('deleteAllFile', 'BookingController@deleteAllBookingFile')->name('deleteAllFile');
    Route::get('trainer/delete/{bookingTrainer}', 'BookingController@deleteTrainer')->name('trainer/delete');
    Route::get('getSchedule/{bookingId}/{currentDate}', 'BookingController@getSchedule')->name('getSchedule');
    Route::post('saveSchedule', 'BookingController@saveSchedule')->name('saveSchedule');
    Route::post('logistics/send-logistics', 'BookingController@sendLogistics')->name('logistics/send-logistics');
    Route::post('logistics/send-books', 'BookingController@sendBooks')->name('logistics/send-books');
    Route::post('ddp-file/upload', 'BookingController@uploadDdpFile')->name('ddp-file/upload');
    Route::post('file/upload', 'BookingController@uploadFile')->name('file/upload');
    Route::post('participants/block-notify', 'BookingController@blockNotify')->name('participants/block-notify');


    Route::group(['prefix' => 'participants'], function () {
        Route::post('/save', 'BookingController@addParticipant')->name('participants/save');
        Route::get('/delete', 'BookingController@deleteParticipant')->name('participants/delete');
        Route::post('/trainer/save', 'BookingController@saveParticipantTrainer')->name('participants/trainer/save');
        Route::post('/vcoach', 'BookingController@saveParticipantVCoach')->name('participants/vcoach');
        Route::post('/session', 'BookingController@saveParticipantSession')->name('participants/session');
        Route::post('send-ina/{id}', 'BookingController@sendIna')->name('participants/send-ina');
        Route::post('send-ddp/{id}', 'BookingController@sendDDP')->name('participants/send-ddp');
        Route::get('ina-share-hash/{id}', 'BookingController@inaShareHash')->name('participants/ina-share-hash');
        Route::post('send-account/{id}', 'BookingController@sendAccount')->name('participants/send-account');
        Route::post('notify/{id}', 'BulkController@sendNotify')->name('participants/notify');
        Route::get('/{bookingId}', 'BookingController@getParticipants')->name('participants');
    });
});
