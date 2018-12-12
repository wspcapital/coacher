<?php


Route::get('/calendar-events', 'CalendarController@getAllEvents')->name('calendar-events');
Route::get('/calendar-search', 'CalendarController@searchCalendar')->name('calendar-search');
Route::get('/calendar-infoBooking', 'CalendarController@infoBooking')->name('calendar-infoBooking');
