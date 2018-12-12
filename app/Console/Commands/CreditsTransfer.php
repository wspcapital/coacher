<?php

namespace App\Console\Commands;

use App\Helpers\Transfer\CreditTransfer,
    Illuminate\Console\Command,
    Illuminate\Support\Facades\DB;

class CreditsTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:credit';

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
        $users = DB::connection('pinnacle')->table('users');
        //->take(10);
        $count = $users->count();

        foreach ($users->get() as $user) {
            CreditTransfer::transfer($user);
            $this->info("Осталось $count");
            $count--;
        }
    }
}
