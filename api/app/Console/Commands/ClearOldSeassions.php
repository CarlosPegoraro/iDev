<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class ClearOldSeassions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:old-seassions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear olds seassions for create new seassions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $timer = new Carbon();
        $timer = $timer->subHours(2);
    }
}
