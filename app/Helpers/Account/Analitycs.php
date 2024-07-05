<?php

namespace App\Helpers\Account;

use App\Helpers\System\CoreHttp;
use App\Helpers\Account\Customer;
use App\Models\EventSection;
use Exception;

class Analitycs
{
    const SEARCH_EVENTS = [];
    const RECOMMEND_EVENTS = [];
    const CUSTOM_EVENTS = [];

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
                return $this->getEventSections("search", $customer->client);
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
                return $this->getEventSections("recommend", $customer->client);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getRecordSearchReportMonth(array $body, array $header = [])
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

    public function getRecordSearchReportDay(array $body, array $header = [])
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

    public function getLimitUsageSearch(array $body, array $header = [])
    {
        return $this->customer->executeWithValidation(
            function() use ($body, $header) {
                $this->customer->validateCustomerKey($header);
                $customer = $this->customer->getCustomerByEncryption($header["customer-key"][0]);
                return $this->arrayLimit($customer->client->limit_query);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getLimitUsageBatch(array $body, array $header = [])
    {
        return $this->customer->executeWithValidation(
            function() use ($body, $header) {
                $this->customer->validateCustomerKey($header);
                $customer = $this->customer->getCustomerByEncryption($header["customer-key"][0]);
                return $this->arrayLimit($customer->client->limit_record);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getLimitUsageEvent(array $body, array $header = [])
    {
        return $this->customer->executeWithValidation(
            function() use ($body, $header) {
                $this->customer->validateCustomerKey($header);
                $customer = $this->customer->getCustomerByEncryption($header["customer-key"][0]);
                return $this->arrayLimit($customer->client->limit_event);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getUsageIndexSearch(array $body, array $header = [])
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

    public function getUsageIndexBatch(array $body, array $header = [])
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
                return $this->getEventSections("custom", $customer->client);
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

    public function getEventSections($type, $client)
    {
        $eventSection = EventSection::where('code', $type)->first();

        if ($eventSection == null) {
            throw new Exception("Tipo de evento no identificado.");
        }

        $events =  $eventSection->events()->where("id_client", $client->id)->get();
        return $this->convertEventArray($events);
    }

    public function convertEventArray($events)
    {
        $data = [];

        foreach ($events as $event) {
            # code...
        }

        return $data;
    }

    public function arrayLimit($value)
    {
        return [
            "limit" => $value ?? 0
        ];
    }
}