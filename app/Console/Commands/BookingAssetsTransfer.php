<?php

namespace App\Console\Commands;

use App\Helpers\Transfer\BookingAssetTransfer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BookingAssetsTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:booking-assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer booking file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $assets = DB::connection('pinnacle')->table('assets')
            ->where('owner_type', 'Booking')
            //->join('bookings', 'bookings.sheet_id', '=', 'booking_sheets.id')
            // ->take(10)
            ->get();
        foreach ($assets as $asset) {
            echo "Booking assets => id = " . $asset->id . " \n";
            BookingAssetTransfer::transfer($asset);
        }
    }
}
