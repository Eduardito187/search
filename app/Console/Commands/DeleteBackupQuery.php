<?php

namespace App\Console\Commands;

use App\Models\BackupQuery;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Carbon\Carbon;

class DeleteBackupQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteBackupQuery:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina la cache de las busquedas de 10min.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fechaLimite = Carbon::now()->subMinutes(10);
        $backupsToDelete = BackupQuery::where('created_at', '<', $fechaLimite)->get();
        $backupsToDelete->each->delete();

        Log::channel('deleteBackupQuery')->info("Cron deleteBackupQuery ejecutado.");
        return Command::SUCCESS;
    }
}