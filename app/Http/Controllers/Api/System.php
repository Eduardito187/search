<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\System\Core;
use App\Helpers\System\CoreHttp;

class System extends Controller
{
    /**
     * @var Core
     */
    protected $core;

    /**
     * @var CoreHttp
     */
    protected $coreHttp;

    public function __construct() {
        $this->core = new Core();
        $this->coreHttp = new CoreHttp();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAllIp(Request $request)
    {
        return response()->json(
            $this->coreHttp->constructResponse(
                $this->core->getAllIp(),
                "",
                200,
                true
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAllConfig(Request $request)
    {
        return response()->json(
            $this->coreHttp->constructResponse(
                $this->core->getAllConfig(),
                "",
                200,
                true
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAllMigrations(Request $request)
    {
        return response()->json(
            $this->coreHttp->constructResponse(
                $this->core->getAllMigrations(),
                "",
                200,
                true
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAllRestictIp(Request $request)
    {
        return response()->json(
            $this->coreHttp->constructResponse(
                $this->core->getAllRestrictIp(),
                "",
                200,
                true
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAllRestictDomain(Request $request)
    {
        return response()->json(
            $this->coreHttp->constructResponse(
                $this->core->getAllRestrictDomain(),
                "",
                200,
                true
            )
        );
    }
}