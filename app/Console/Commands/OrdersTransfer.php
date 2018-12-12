<?php

namespace App\Console\Commands;

use App\Helpers\Transfer\OrderTransfer,
    Illuminate\Console\Command,
    Illuminate\Support\Facades\DB;

class OrdersTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer orders';

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
            ->where('id', '>', 2139)
            ->where('Source', '!=', 'Bulk')
            //->take(1)
            ->get();

            //->find(2336);
        foreach ($orders as $order) {
            $this->info("Order id => $order->id");
            OrderTransfer::transfer($order);
        }
    }
}
