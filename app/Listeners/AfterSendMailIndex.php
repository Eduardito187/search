<?php

namespace App\Listeners;

use App\Events\SendMailIndex;
use App\Helpers\Account\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AfterSendMailIndex implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The maximum number of attempts.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @return array|int
     */
    public function backoff()
    {
        return [10, 30, 60];
    }

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
    public string $queue = 'send_mail_index';

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
     * @param SendMailIndex $event
     * @return void
     */
    public function handle(SendMailIndex $event)
    {
        $this->customer->proccessMailingIndex(
            $event->idClient,
            $event->idIndex,
            $event->idMail,
            $event->idMailingIndex
        );
    }
}