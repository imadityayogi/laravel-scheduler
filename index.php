follow these steps

//in pills-reminder/app/Console/Commands/
create a file
//SendNotifications.php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Log;

class SendNotifications extends Command
{
    protected $signature = 'notifications:send';
    protected $description = 'Send notifications to users';

    protected $applicationController;

    public function __construct(ApplicationController $applicationController)
    {
        parent::__construct();
        $this->applicationController = $applicationController;
    }

    public function handle()
    {
        Log::info('Notifications task started.');

        try {
            $this->applicationController->cron();
            Log::info('Notifications task completed successfully.');
        } catch (\Exception $e) {
            Log::error('Notifications task failed: ' . $e->getMessage());
        }
    }
}


//in pills-reminder/app/Console/Kernel.php
<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        Log::info('Console Notifications task started.');
        $schedule->command('notifications:send')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

// in ApplicationController//
create function
function cron{
//write your logic
}
