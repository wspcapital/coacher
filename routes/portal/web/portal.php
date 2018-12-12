<?php


Route::group(['namespace' => 'Portal'], function () {
    include('home.php');
    include('vcoach.php');
    include('my-videos.php');
    include('profile.php');
    include('video-tips.php');
    include('library.php');
    include('how-to.php');
    include('charge.php');
    include('chat.php');
});
