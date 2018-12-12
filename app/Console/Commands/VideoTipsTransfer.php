<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Helpers\Transfer\VideoTipTransfer;

class VideoTipsTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:video-tips';

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
        $videoTips = DB::connection('pinnacle')->table('assets')->where('category', 32);

        $count = $videoTips->count();
        foreach ($videoTips->get() as $asset) {
            VideoTipTransfer::transfer($asset);
            $count--;
            $this->line("Inserted $asset->id. Rested: $count");
        }

        $this->info("Inserted $count raws");
    }
}
