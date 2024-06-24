<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
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
        $schedule->command('backupDB:cron')->dailyAt('0:00');
        $schedule->command('deleteBackupQuery:cron')->everyFiveMinutes();
        //$schedule->command('runnerRulesExclude:cron')->everyFiveMinutes();
        $schedule->command('disabledIndexProducts:cron')->twiceDaily(0, 12);
        $schedule->command('proccessJobs:cron')->everyMinute();
        $schedule->command('jobIndexationProccess:cron')->everyMinute();
        $schedule->command('jobRestorePassword:cron')->everyMinute();
        $schedule->command('jobRestorePasswordConfirm:cron')->everyMinute();
        $schedule->command('jobSaveHistoryCustomerUuid:cron')->everyMinute();
        $schedule->command('jobSearchProccess:cron')->everyMinute();
        $schedule->command('jobSendMailIndex:cron')->everyMinute();
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
