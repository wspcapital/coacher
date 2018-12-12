<?php

namespace App\Console\Commands;

use Illuminate\Console\Command,
    Illuminate\Support\Facades\DB,
    App\Helpers\Transfer\UserTransfer;

class UsersTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer old users';

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
        $count= $users->count();

        foreach ($users->get() as $user) {
            UserTransfer::transfer($user);
            $this->line("осталось $count User.id => $user->id");
            $count--;
        }

        $this->line("Assistant");


        foreach ($users->get() as $user) {
            if ($user->assistant_id != '0') {
                UserTransfer::transfer($user, 'Assistant');
                $this->line("Assistant  $user->id");
            }
        }

      /*  $this->info("Inserted $countUsers raws to users \n ");
        $this->info("Inserted $countAssist raws to user_assistants \n ");*/
    }
}
