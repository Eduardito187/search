<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\System\CoreHttp;
use App\Helpers\System\Client;

class Core extends Controller
{
    /**
     * @var CoreHttp
     */
    protected $coreHttp;

    /**
     * @var Client
     */
    protected $client;

    public function __construct() {
        $this->coreHttp = new CoreHttp();
        $this->client = new Client();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function createClient(Request $request)
    {
        return response()->json(
            $this->client->proccessCreateCliente(
                $request->all(),
                $request->header()
            )
        );
    }
}