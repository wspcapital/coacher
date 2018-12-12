<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class AsteriskSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asterisk:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up Asterisk Config and populate it with users existing in the database.';

    /**
     * Path to Asterisk Config file.
     *
     * @var string
     */
    private $config_path = "path/to/conf.sip";

    /**
     * Create a new command instance.
     *
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
        $users = User::all();

        foreach ($users as $user) {
            $user_data = "[$user->id](webrtc)\n";
            $user_data .= "defaultusername=$user->full_name\n";
            $user_data .= "secret={$user->id}badpassword-test-pass\n\n";
            file_put_contents($this->config_path, $user_data, FILE_APPEND | LOCK_EX);
        }

        $this->info("Asterisk was successfully set up.");
    }
}
