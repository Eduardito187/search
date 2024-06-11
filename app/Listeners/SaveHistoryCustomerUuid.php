<?php

namespace App\Listeners;

use App\Events\HistoryCustomerUuid;
use App\Helpers\System\CoreHttp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveHistoryCustomerUuid implements ShouldQueue
{
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public string $connection = 'database';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public string $queue = 'save_history_customer_uuid';

    /**
     * @var CoreHttp
     */
    protected $coreHttp;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->coreHttp = new coreHttp();
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\HistoryCustomerUuid  $event
     * @return void
     */
    public function handle(HistoryCustomerUuid $event)
    {
        $this->coreHttp->setCustomerHistoryUuid(
            $event->ip,
            $event->customerUuid
        );
    }
}