<?php

namespace App\Console\Commands;

use App\Helpers\Transfer\LessonTransfer,
    Illuminate\Console\Command,
    Illuminate\Support\Facades\DB;

class LessonsTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:lessons';

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
        $lessons = DB::connection('pinnacle')->table('workshop_lessons')->get();

        $count = 0;
        foreach ($lessons as $lesson) {
            LessonTransfer::transfer($lesson);
            $this->line("Inserted $lesson->id");
            $count++;
        }

        $this->info("Inserted $count raws");
    }
}
