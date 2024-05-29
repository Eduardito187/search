<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Account\Customer;

class Account extends Controller
{
    /**
     * @var Customer
     */
    protected $customer;

    /**
     * Constructor Account Customer
     */
    public function __construct() {
        $this->customer = new Customer();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function customerValidateLogin(Request $request)
    {
        return response()->json(
            $this->customer->customerValidateLogin(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function customerResetPassword(Request $request)
    {
        return response()->json(
            $this->customer->customerResetPassword(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function generatePassword(Request $request)
    {
        return response()->json(
            $this->customer->generatePasswordCustomer(
                $request->all(),
                $request->header()
            )
        );
    }
}