<?php

namespace App\Providers;

use App\Events\SearchProccess;
use App\Listeners\AfterSearchProccess;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
     /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SearchProccess::class => [
            AfterSearchProccess::class,
        ]
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){
    }
}
