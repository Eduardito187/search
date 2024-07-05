<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Account\Analitycs;

class Events extends Controller
{
    /**
     * @var Analitycs
     */
    protected $analitycs;

    /**
     * Constructor Events
     */
    public function __construct(
        Analitycs $analitycs
    ) {
        $this->analitycs = $analitycs;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setEvent(Request $request)
    {
        return response()->json(
            $this->analitycs->registerEvent(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAllEvents(Request $request)
    {
        return response()->json(
            $this->analitycs->getAllEvents(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAllEventSearch(Request $request)
    {
        return response()->json(
            $this->analitycs->getAllEventSearch(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAllEventRecommend(Request $request)
    {
        return response()->json(
            $this->analitycs->getAllEventRecommend(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAllEventCustom(Request $request)
    {
        return response()->json(
            $this->analitycs->getAllEventCustom(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getRecordSearchReportMonth(Request $request)
    {
        return response()->json(
            $this->analitycs->getRecordSearchReportMonth(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getRecordSearchReportDay(Request $request)
    {
        return response()->json(
            $this->analitycs->getRecordSearchReportDay(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getLimitUsageSearch(Request $request)
    {
        return response()->json(
            $this->analitycs->getLimitUsageSearch(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getLimitUsageBatch(Request $request)
    {
        return response()->json(
            $this->analitycs->getLimitUsageBatch(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getLimitUsageEvent(Request $request)
    {
        return response()->json(
            $this->analitycs->getLimitUsageEvent(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getUsageIndexSearch(Request $request)
    {
        return response()->json(
            $this->analitycs->getUsageIndexSearch(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getUsageIndexBatch(Request $request)
    {
        return response()->json(
            $this->analitycs->getUsageIndexBatch(
                $request->all(),
                $request->header()
            )
        );
    }
}