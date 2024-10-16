<?php

namespace App\Console;

use App\Models\Team;
use App\Models\Stadium;
use App\Models\AllMatches;
use App\Models\Competition;
use App\Console\Commands\Matches;
use Illuminate\Support\Facades\Http;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        Matches::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:matches')->daily();
        $schedule->command('app:return-panned-fans')->daily();
        $schedule->command('app:update-active-tickets')->daily();

    }

    /**$stadium
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
