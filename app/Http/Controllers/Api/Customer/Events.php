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
}