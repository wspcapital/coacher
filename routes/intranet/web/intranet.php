<?php


Route::group(['namespace' => 'Intranet'], function () {
    include('booking.php');
    include('users.php');
    include('posts.php');
    include('orders.php');
    include('shared-video.php');
    include('libs.php');
    include('bulks.php');
    include('bookouts.php');
    include('calendar.php');
    include('coupons.php');
    include('payments.php');
    include('chat.php');
});
