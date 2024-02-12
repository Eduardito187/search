<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Carbon\Carbon;

class DisabledProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disabledProducts:cron';

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
        $products = Product::where('status', true)->where('updated_at', '>', $fechaLimite)->get();

        foreach ($products as $product) {
            Log::channel('disabledProducts')->info(__("Product ID:%1 disabled.", $product->id));
            $product->status = false;
            $product->save();
        }

        Log::channel('disabledProducts')->info("Cron disabledProducts ejecutado.");
        return Command::SUCCESS;
    }
}