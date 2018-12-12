<?php

namespace App\Console\Commands;

use App\Helpers\Transfer\UserVideoTransfer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UserVideosTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:user-videos';

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
        $assets = DB::connection('pinnacle')->table('assets')
            ->where('type', 'Video')
            ->where('owner_type', 'Admin');
            //->where('id', '46080');   /// webinar
            //->get();
            $count = $assets->count();

        foreach ($assets->get() as $asset) {
            UserVideoTransfer::transfer($asset);
            $count--;
            $this->info("Осталось $count ");
        }
    }
}
