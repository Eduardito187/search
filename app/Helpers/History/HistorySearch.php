<?php

namespace App\Helpers\History;

use Exception;
use App\Models\HistoryQuerySearch;

class HistorySearch
{
    public function __construct() {
        //
    }

    /**
     * @inheritDoc
     */
    public function saveQuerySearchHistory($idClient, $idIndex, $customerUuid, $query, $countItems, $code)
    {
        \Illuminate\Support\Facades\Log::info("runner AfterSearchProccess saveQuerySearchHistory");
        try {
            $newHistoryQuerySearch = new HistoryQuerySearch();
            $newHistoryQuerySearch->id_client = $idClient;
            $newHistoryQuerySearch->id_index = $idIndex;
            $newHistoryQuerySearch->customer_uuid = $customerUuid;
            $newHistoryQuerySearch->query = $query;
            $newHistoryQuerySearch->count_items = $countItems;
            $newHistoryQuerySearch->code = $code;
            $newHistoryQuerySearch->created_at = date("Y-m-d H:i:s");
            $newHistoryQuerySearch->updated_at = null;
            $newHistoryQuerySearch->save();
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::info("runner AfterSearchProccess saveQuerySearchHistory => ".$e->getMessage());
            return null;
        }
    }
}