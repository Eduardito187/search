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
    public string $queue = 'search_proccess';

    /**
     * @var HistorySearch
     */
    protected $historySearch;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(HistorySearch $historySearch)
    {
        $this->historySearch = $historySearch;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SearchProccess  $event
     * @return void
     */
    public function handle(SearchProccess $event)
    {
        $this->historySearch->saveQuerySearchHistory(
            $event->idClient,
            $event->idIndex,
            $event->customerUuid,
            $event->query,
            $event->countItems,
            $event->timeExecution,
            $event->code
        );
    }
}