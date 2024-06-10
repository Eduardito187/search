<?php

namespace App\Listeners;

use App\Events\SearchProccess;
use App\Helpers\History\HistorySearch;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AfterSearchProccess implements ShouldQueue
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
    public string $queue = 'listeners';

    /**
     * @var HistorySearch
     */
    protected $historySearch;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->historySearch = new HistorySearch();
        \Illuminate\Support\Facades\Log::info("runner AfterSearchProccess");
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SearchProccess  $event
     * @return void
     */
    public function handle(SearchProccess $event)
    {
        \Illuminate\Support\Facades\Log::info("runner AfterSearchProccess handle");
        $this->historySearch->saveQuerySearchHistory(
            $event->idClient,
            $event->idIndex,
            $event->customerUuid,
            $event->query,
            $event->countItems,
            $event->code
        );
    }
}