<?php

namespace App\Console\Commands;

use App\Helpers\Transfer\BulkTransfer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BulksTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:bulks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $orders = DB::connection('pinnacle')->table('orders')
            ->where('source', 'Bulk');
            //->where('owner_type', 'Admin')
          //  ->where('id', '511');   /// webinar
          $count = $orders->count();

        foreach ($orders->get() as $order) {
            echo "Order.id => " . $order->id;
            BulkTransfer::transfer($order);
            $count--;
            $this->info("Осталось $count");
        }
    }
}
