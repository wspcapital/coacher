<?php

namespace App\Console;

use App\Console\Commands\AllTransfer,
    App\Console\Commands\BookingAssetsTransfer,
    App\Console\Commands\BookingsTransfer,
    App\Console\Commands\BulksTransfer,
    App\Console\Commands\LessonsTransfer,
    App\Console\Commands\OrdersTransfer,
    App\Console\Commands\UsersTransfer,
    App\Console\Commands\VideoTipsTransfer,
    App\Console\Commands\LibsTransfer,
    App\Console\Commands\UserVideosTransfer,
    Illuminate\Console\Scheduling\Schedule,
    Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\ChatServer;
use App\Console\Commands\CreditsTransfer;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        UsersTransfer::class,
        BookingsTransfer::class,
        LessonsTransfer::class,
        AllTransfer::class,
        BookingAssetsTransfer::class,
        OrdersTransfer::class,
        UserVideosTransfer::class,
        BulksTransfer::class,
        CreditsTransfer::class,
        VideoTipsTransfer::class,
        LibsTransfer::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
