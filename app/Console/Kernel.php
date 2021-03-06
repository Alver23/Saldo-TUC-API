<?php

namespace App\Console;

use App\Console\Commands\DeleteOldNotifications;
use App\Console\Commands\QueueRequestsForAllCards;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        DeleteOldNotifications::class,
        QueueRequestsForAllCards::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('saldotuc:notifications:delete')
            ->hourly()
            ->thenPing('http://beats.envoyer.io/heartbeat/igVnYOlRQEqsC86');

        $schedule->command('saldotuc:queueForCards')
            ->cron('0 6-20 * * * *')
            ->timezone('America/Managua')
            ->thenPing('http://beats.envoyer.io/heartbeat/CLsiwDSqD6XPDu7');
    }
}
