<?php


Route::group(['namespace' => 'Api'], function () {

    include('users.php');
    include('work-shop.php');
    include('learning-video.php');
    include('webinar-videos.php');
    include('shared-video.php');
    include('bookings.php');
    include('posts.php');
    include('bulks.php');
    include('calendar.php');
    include('orders.php');
});
