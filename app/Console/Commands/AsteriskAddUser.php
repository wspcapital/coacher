<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class AsteriskAddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asterisk:add-user {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new user to Asterisk Config.';

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
        $user = User::find($this->argument("user_id"));

        $user_data = "[$user->id](webrtc)\n";
        $user_data .= "defaultusername=$user->full_name\n";
        $user_data .= "secret={$user->id}badpassword-test-pass\n\n";

        file_put_contents($this->config_path, $user_data, FILE_APPEND | LOCK_EX);

        $this->info("Asterisk was successfully set up.");
    }
}
