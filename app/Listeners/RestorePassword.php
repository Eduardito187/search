<?php

namespace App\Listeners;

use App\Events\SendEmailRestorePassword;
use App\Helpers\Account\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RestorePassword implements ShouldQueue
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
    public string $queue = 'restore_password';

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Handle the event.
     *
     * @param SendEmailRestorePassword $event
     * @return void
     */
    public function handle(SendEmailRestorePassword $event)
    {
        $this->customer->proccessRestorePassword(
            $event->email
        );
    }
}