<?php

namespace App\Helpers\Account;

use App\Helpers\System\CoreHttp;
use App\Helpers\Account\Customer;

class Analitycs
{
    /**
     * @var CoreHttp
     */
    protected $coreHttp;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @param CoreHttp $coreHttp
     * @param Customer $customer
     */
    public function __construct(
        CoreHttp $coreHttp,
        Customer $customer
    ) {
        $this->coreHttp = $coreHttp;
        $this->customer = $customer;
    }

    public function registerEvent(array $body, array $header = [])
    {
        return $this->customer->executeWithValidation(
            function() use ($header) {
                $this->customer->validateCustomerKey($header);
                $currentCustomer = $this->customer->getCustomerByEncryption($header["customer-key"][0]);
                $data = [];

                return $data;
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getAllEventSearch(array $body, array $header = [])
    {
        return $this->customer->executeWithValidation(
            function() use ($body, $header) {
                $this->customer->validateCustomerKey($header);
                $customer = $this->customer->getCustomerByEncryption($header["customer-key"][0]);
                return [];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getAllEventRecommend(array $body, array $header = [])
    {
        return $this->customer->executeWithValidation(
            function() use ($body, $header) {
                $this->customer->validateCustomerKey($header);
                $customer = $this->customer->getCustomerByEncryption($header["customer-key"][0]);
                return [];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getAllEventCustom(array $body, array $header = [])
    {
        return $this->customer->executeWithValidation(
            function() use ($body, $header) {
                $this->customer->validateCustomerKey($header);
                $customer = $this->customer->getCustomerByEncryption($header["customer-key"][0]);
                return [];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getAllEvents(array $body, array $header = [])
    {
        return $this->customer->executeWithValidation(
            function() use ($body, $header) {
                $this->customer->validateCustomerKey($header);
                $customer = $this->customer->getCustomerByEncryption($header["customer-key"][0]);
                $page = 1;

                if (isset($body["pagination"])) {
                    $page = $body["pagination"];
                }

                $events = $customer->client->allEvents()->orderBy('id', 'desc')->paginate(6, ['*'], 'page', $page);

                $dataEvent = $events->map(function($event) {
                    return [
                        "id" => $event->id,
                        "name" => $event->name,
                        "code" => $event->code,
                        "type" => [
                            "type" => $event->type->type,
                            "name" => $event->type->name
                        ]
                    ];
                });

                return [
                    'data' => $dataEvent,
                    'current_page' => $events->currentPage(),
                    'last_page' => $events->lastPage(),
                    'per_page' => $events->perPage(),
                    'total' => $events->total()
                ];
            },
            "Proceso ejecutado exitosamente."
        );
    }
}