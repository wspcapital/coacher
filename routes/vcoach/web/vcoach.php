<?php

Route::group(['prefix' => 'vcoach'], function () {
    Route::get('/', 'VCoachController@getIndex')->name('vcoach');
    Route::get('/about', 'VCoachController@getAbout')->name('about');
    Route::get('/features', 'VCoachController@getFeatures')->name('features');
    Route::get('/prices', 'VCoachController@getPrices')->name('prices');
    Route::post('/prices', 'VCoachController@postPrices')->name('prices');
    Route::get('/how-it-works', 'VCoachController@getHowItWorks')->name('how-it-works');
    Route::get('/faqs', 'VCoachController@getFaqs')->name('faqs');
    Route::get('/terms', 'VCoachController@getTerms')->name('terms');
    Route::get('/contact', 'VCoachController@getContact')->name('contact');
    Route::get('/sign-up', 'VCoachController@getSignUp')->name('sign-up');
});
