<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProccessJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proccessJobs:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute proccess jobs.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        exec("php artisan queue:work database --queue=search_proccess --stop-when-empty");
        exec("php artisan queue:work database --queue=indexation_proccess --stop-when-empty");
        exec("php artisan queue:work database --queue=save_history_customer_uuid --stop-when-empty");
        exec("php artisan queue:work database --queue=restore_password --stop-when-empty");
        exec("php artisan queue:work database --queue=restore_password_confirm --stop-when-empty");
        exec("php artisan queue:work database --queue=send_mail_index --stop-when-empty");
        return Command::SUCCESS;
    }
}