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
    public function __construct(Customer $customer) {
        $this->customer = $customer;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function closeSession(Request $request)
    {
        return response()->json(
            $this->customer->closeSession(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getCustomerInformation(Request $request)
    {
        return response()->json(
            $this->customer->getCustomerInformation(
                $request->all(),
                $request->header()
            )
        );
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

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getDashboardData(Request $request)
    {
        return response()->json(
            $this->customer->getDashboardData(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getInfraestructureData(Request $request)
    {
        return response()->json(
            $this->customer->getInfraestructureData(
                $request->all(),
                $request->header()
            )
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAplicationData(Request $request)
    {
        return response()->json(
            $this->customer->getAplicationData(
                $request->all(),
                $request->header()
            )
        );
    }
}