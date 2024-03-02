<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\System\CoreHttp;
use App\Helpers\Search\Core;

class Product extends Controller
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
    public function searchProductFeed(Request $request)
    {
        return response()->json(
            $this->core->productFeed(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function searchProductResult(Request $request)
    {
        return response()->json(
            $this->core->productResult(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getFiltersPage(Request $request)
    {
        return response()->json(
            $this->core->getFiltersPage(
                $request->all(),
                $request->header()
            )
        );
    }
}
