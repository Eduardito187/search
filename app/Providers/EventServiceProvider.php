<?php

namespace App\Providers;

use App\Events\HistoryCustomerUuid;
use App\Events\IndexationProccess;
use App\Listeners\AfterIndexationProccess;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\SearchProccess;
use App\Events\SendEmailConfirmRestorePassword;
use App\Events\SendEmailRestorePassword;
use App\Listeners\AfterSearchProccess;
use App\Listeners\RestorePassword;
use App\Listeners\RestorePasswordConfirm;
use App\Listeners\SaveHistoryCustomerUuid;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SearchProccess::class => [
            AfterSearchProccess::class,
        ],
        IndexationProccess::class => [
            AfterIndexationProccess::class
        ],
        HistoryCustomerUuid::class => [
            SaveHistoryCustomerUuid::class
        ],
        SendEmailRestorePassword::class => [
            RestorePassword::class
        ],
        SendEmailConfirmRestorePassword::class => [
            RestorePasswordConfirm::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
