<?php

namespace App\Console\Commands;

use App\Helpers\Transfer\BookingTransfer;
use App\Models\Booking;
use App\Models\BookingParticipants;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BookingsTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:bookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bookings transfer';

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
        $bookingSheets = DB::connection('pinnacle')->table('booking_sheets');
              //->where('id', '>', 3767);
            //->join('bookings', 'bookings.sheet_id', '=', 'booking_sheets.id')
            // ->take(10)


        $count = $bookingSheets->count();

        foreach ($bookingSheets->get() as $bookingSheet) {
            BookingTransfer::transfer($bookingSheet);
            $this->line("Осталось  $count Booking.id => $bookingSheet->id");
            $count--;
        }
        $this->info("Inserted $count raws");
    }
}
