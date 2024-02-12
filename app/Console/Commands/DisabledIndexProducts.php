<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\ProductIndex;
use Carbon\Carbon;

class DisabledIndexProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disabledIndexProducts:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Desactiva productos no actualizados en las ultimas 24hrs.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fechaLimite = Carbon::now()->subHours(24);
        $productsIndex = ProductIndex::where('status', true)->where('updated_at', '>', $fechaLimite)->get();

        foreach ($productsIndex as $product) {
            Log::channel('disabledIndexProducts')->info(__("Product ID:%1 disabled.", $product->id_product));
            $product->status = false;
            $product->save();
        }

        Log::channel('disabledIndexProducts')->info("Cron disabledIndexProducts ejecutado.");
        return Command::SUCCESS;
    }
}