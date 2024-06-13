<?php

namespace App\Helpers\Account;

use App\Helpers\System\CoreHttp;
use App\Models\CustomersAccount;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Customer
{
    /**
     * @var CoreHttp
     */
    protected $coreHttp;

    /**
     * Constructor Customer Account Helper
     */
    public function __construct()
    {
        $this->coreHttp = new CoreHttp();
    }

    /**
     * @inheritDoc
     */
    public function closeSession(array $body, array $header = [])
    {
        try {
            if (
                !is_array($header) ||
                !isset($header["customer-key"]) ||
                !is_array($header["customer-key"]) ||
                count($header["customer-key"]) == 0
            ) {
                throw new Exception("Parametros no validos.");
            }

            $this->validateCustomerEncryption($header["customer-key"][0]);
            $this->removeCookie("customer_backend");

            return $this->coreHttp->constructResponse(
                [],
                "Proceso ejecutado exitosamente.",
                200,
                true
            );
        } catch (Exception $e) {
            return $this->coreHttp->constructResponse([], $e->getMessage(), 500, false);
        }
    }

    /**
     * @inheritDoc
     */
    public function removeCookie(string $key)
    {
        $_COOKIE[$key] = null;
    }

    /**
     * @inheritDoc
     */
    public function setCookie(string $key, string $value)
    {
        $_COOKIE[$key] = $value;
    }

    /**
     * @inheritDoc
     */
    public function getCustomerInformation(array $body, array $header = [])
    {
        try {
            if (
                !is_array($header) ||
                !isset($header["customer-key"]) ||
                !is_array($header["customer-key"]) ||
                count($header["customer-key"]) == 0
            ) {
                throw new Exception("Parametros no validos.");
            }

            return $this->coreHttp->constructResponse(
                $this->getCustomerArrayByEncryption($header["customer-key"][0]),
                "Proceso ejecutado exitosamente.",
                200,
                true
            );
        } catch (Exception $e) {
            return $this->coreHttp->constructResponse([], $e->getMessage(), 500, false);
        }
    }

    /**
     * @inheritDoc
     */
    public function customerValidateLogin(array $body, array $header = [])
    {
        try {
            if (!is_array($body) || !isset($body["password"]) || !isset($body["mail"])) {
                throw new Exception("Parametros no validos.");
            }

            return $this->coreHttp->constructResponse(
                $this->validateLoginAccount($body["mail"], $body["password"]),
                "Proceso ejecutado exitosamente.",
                200,
                true
            );
        } catch (Exception $e) {
            return $this->coreHttp->constructResponse([], $e->getMessage(), 500, false);
        }
    }

    /**
     * @inheritDoc
     */
    public function customerResetPassword(array $body, array $header = [])
    {
        try {
            if (!is_array($body) || !isset($body["mail"])) {
                throw new Exception("Parametros no validos.");
            }

            return $this->coreHttp->constructResponse(
                [],
                "Proceso ejecutado exitosamente.",
                200,
                true
            );
        } catch (Exception $e) {
            return $this->coreHttp->constructResponse([], $e->getMessage(), 500, false);
        }
    }

    /**
     * @inheritDoc
     */
    public function validateCustomerEncryption(string $keyEncryption)
    {
        $descryptionMail = $this->decrypt($keyEncryption);
        
        $customer = CustomersAccount::where('mail', $descryptionMail)->first();

        if ($customer == null) {
            throw new Exception("Customer no indentificado.");
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function getCustomerByEncryption(string $keyEncryption)
    {
        $descryptionMail = $this->decrypt($keyEncryption);
        
        $customer = CustomersAccount::where('mail', $descryptionMail)->first();

        if ($customer == null) {
            throw new Exception("Customer no indentificado.");
        }

        return $customer;
    }

    /**
     * @inheritDoc
     */
    public function getCustomerArrayByEncryption(string $keyEncryption)
    {
        $descryptionMail = $this->decrypt($keyEncryption);
        
        $customer = CustomersAccount::where('mail', $descryptionMail)->first();

        if ($customer == null) {
            throw new Exception("Customer no indentificado.");
        }

        return $this->entityCustomerArray($customer);
    }

    /**
     * @inheritDoc
     */
    public function entityCustomerArray(CustomersAccount $customer)
    {
        $customerAccountInformation = $customer->customerAccountInformation;

        return [
            'mail' => $customer->mail,
            'status' => $customer->status,
            'first_name' => $customerAccountInformation->first_name,
            'last_name' => $customerAccountInformation->last_name,
            'phone_number' => $customerAccountInformation->phone_number,
            'company' => $customerAccountInformation->company
        ];
    }

    /**
     * @inheritDoc
     */
    public function validateLoginAccount($mail, $password)
    {
        $customer = CustomersAccount::where('mail', $mail)->first();

        if ($customer != null) {
            $encryptPassword = $this->encryptedPawd($password);

            if ($customer->password == $encryptPassword) {
                $encryptKey = $this->encrypt($mail);
                $this->setCookie("customer_backend", $encryptKey);

                return ["message" => 'Inicio de sesion exitoso.', "status" => true, 'customer' => $encryptKey];
            } else {
                return ["message" => 'Contraseña erronea.', "status" => false];
            }
        }

        return ["message" => 'El mail no esta asignado a una cuenta.', "status" => false];
    }

    /**
     * @inheritDoc
     */
    public function getDashboardData(array $body, array $header = [])
    {
        try {
            if (
                !is_array($header) ||
                !isset($header["customer-key"]) ||
                !is_array($header["customer-key"]) ||
                count($header["customer-key"]) == 0
            ) {
                throw new Exception("Parametros no validos.");
            }

            $customer = $this->getCustomerByEncryption($header["customer-key"][0]);

            return $this->coreHttp->constructResponse(
                $this->getDataDashboard($customer),
                "Proceso ejecutado exitosamente.",
                200,
                true
            );
        } catch (Exception $e) {
            return $this->coreHttp->constructResponse([], $e->getMessage(), 500, false);
        }
    }

    /**
     * @inheritDoc
     */
    public function getDataDashboard($customer)
    {
        $currentClient = $customer->client;
        //$currentClient->recentMonthHistoryIndex;
        return [
            "query" => $this->generateStructureDataBody($currentClient->recentMonthHistoryQuerySearch(), true),
            "suggestion" => $this->generateStructureDataBody($currentClient->recentMonthHistoryQuerySearchSuggestion()),
            "data" => []
        ];
    }

    /**
     * @inheritDoc
     */
    public function generateStructureDataBody($collection, $generateTime = false)
    {
        $data = [];
        $data["counter"] = $this->getCounterDataArray($collection);

        if ($generateTime) {
            $data["time"] = $this->getTimeDataArray($collection);
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function generateDateArray()
    {
        $datesArray = [];

        for ($i = 0; $i < 30; $i++) {
            $datesArray[] = Carbon::today()->subDays($i)->toDateString();
        }

        return ["label" => $datesArray, "data" => []];
    }

    /**
     * @inheritDoc
     */
    public function getCounterDataArray($collection)
    {
        $structure = $this->generateDateArray();

        foreach ($structure["label"] as $key => $date) {
            $newCollection = clone $collection;
            $structure["data"][] = $newCollection->whereDate("created_at", "=", $date)->count();
        }

        return $structure;
    }

    /**
     * @inheritDoc
     */
    public function getTimeDataArray($collection)
    {
        $structure = $this->generateDateArray();

        foreach ($structure["label"] as $key => $date) {
            $newCollection = clone $collection;
            $structure["data"][] = $newCollection->whereDate("created_at", "=", $date)->avg("time_execution");
        }

        return $structure;
    }

    /**
     * @inheritDoc
     */
    public function generatePasswordCustomer(array $body, array $header = [])
    {
        try {
            if (!is_array($body) || !isset($body["password"])) {
                throw new Exception("Parametros no validos.");
            }

            return $this->coreHttp->constructResponse(
                [
                    "password" => $this->encryptedPawd($body["password"])
                ],
                "Proceso ejecutado exitosamente.",
                200,
                true
            );
        } catch (Exception $e) {
            return $this->coreHttp->constructResponse([], $e->getMessage(), 500, false);
        }
    }

    /**
     * @inheritDoc
     */
    public function encryptedPawd(string $password){
        return hash_hmac('sha256', $password, env('ENCRYPTION_KEY'));
    }

    /**
     * @inheritDoc
     */
    function encrypt($data)
    {
        $iv = str_repeat('0', openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', env('ENCRYPTION_KEY'), 0, $iv);
        return base64_encode($encrypted);
    }

    /**
     * @inheritDoc
     */
    function decrypt($data)
    {
        $iv = str_repeat('0', openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted_data = base64_decode($data);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', env('ENCRYPTION_KEY'), 0, $iv);
    }
}