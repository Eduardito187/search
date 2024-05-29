<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Account extends Controller
{
    public function __construct() {
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function customerValidateLogin(Request $request)
    {
        return response()->json();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function customerResetPassword(Request $request)
    {
        return response()->json();
    }
}