<?php

namespace App\Console\Commands;

use Illuminate\Console\Command,
    Illuminate\Support\Facades\DB,
    App\Helpers\Transfer\LibTransfer;

class LibsTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:libs';

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
        $libs = DB::connection('pinnacle')->table('assets')->where('owner_type', 'Library');

        $count = $libs->count();
        foreach ($libs->get() as $asset) {
            LibTransfer::transfer($asset);
            $count--;
            $this->line("Inserted $asset->id. Rested: $count");
        }

        $this->info("Inserted $count raws");
    }
}
