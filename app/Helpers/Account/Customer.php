<?php

namespace App\Helpers\Account;

use App\Events\SendEmailConfirmRestorePassword;
use App\Events\SendEmailRestorePassword;
use App\Helpers\System\CoreHttp;
use App\Models\CustomersAccount;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helpers\SendMail;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Event;

use Illuminate\Support\Str;

class Customer
{
    protected $coreHttp;

    public function __construct(CoreHttp $coreHttp)
    {
        $this->coreHttp = $coreHttp;
    }

    public function closeSession(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $this->removeCookie("customer_backend");
                return [];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function removeCookie(string $key)
    {
        unset($_COOKIE[$key]);
    }

    public function setCookie(string $key, string $value)
    {
        $_COOKIE[$key] = $value;
    }

    public function getCustomerInformation(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                return $this->getCustomerArrayByEncryption($header["customer-key"][0]);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function customerValidateLogin(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($body) {
                $this->validateLoginParams($body);
                return $this->validateLoginAccount($body["mail"], $body["password"]);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function customerResetPassword(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($body) {
                $this->validateResetPasswordParams($body);
                return [];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    private function executeWithValidation(callable $callback, string $successMessage)
    {
        try {
            $result = $callback();
            return $this->coreHttp->constructResponse($result, $successMessage, 200, true);
        } catch (Exception $e) {
            return $this->coreHttp->constructResponse([], $e->getMessage(), 500, false);
        }
    }

    private function validateCustomerKey(array $header)
    {
        if (
            !isset($header["customer-key"]) ||
            !is_array($header["customer-key"]) ||
            count($header["customer-key"]) === 0
        ) {
            throw new Exception("Parametros no validos.");
        }

        $this->validateCustomerEncryption($header["customer-key"][0]);
    }

    private function validateLoginParams(array $body)
    {
        if (!isset($body["password"]) || !isset($body["mail"])) {
            throw new Exception("Parametros no validos.");
        }
    }

    public function sendConfirmRestorePassword($email)
    {
        new SendMail("mail.reset-password", $email, "Restauracion de contraseña.", [
            "title" => "Contraseña restaurada",
            "footer_text" => "Felicidades tu contraseña ha sido restaurada exitosamente."
        ]);
    }

    public function sendEventRestorePassword($mail)
    {
        Event::dispatch(new SendEmailRestorePassword($mail));
    }

    public function sendEventConfirmRestorePassword($mail)
    {
        Event::dispatch(new SendEmailConfirmRestorePassword($mail));
    }

    public function proccessRestorePassword($email)
    {
        $token = Str::random(60);
        PasswordReset::updateOrCreate(
            ['email' => $email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        new SendMail("mail.confirmation-password", $email, "Restauracion de contraseña.", [
            "title" => "Restaura tu contraseña",
            "description" => "Haga clic aquí para restablecer la contraseña.",
            "footer_text" => "Si esto fue un error, simplemente ignora este correo electrónico y no pasará nada.",
            "token" => $token
        ]);
    }

    private function validateResetPasswordParams(array $body)
    {
        if (!isset($body["mail"])) {
            throw new Exception("Parametros no validos.");
        }

        $customer = $this->getCustomerByMail($body["mail"]);

        if ($customer == null) {
            throw new Exception("Customer no identificado.");
        }

        $this->sendEventRestorePassword($customer->mail);
    }

    public function getCustomerByMail(string $mail)
    {
        return CustomersAccount::where('mail', $mail)->first();
    }

    private function validateCustomerEncryption(string $keyEncryption)
    {
        $descryptionMail = $this->decrypt($keyEncryption);
        $customer = $this->getCustomerByMail($descryptionMail);

        if (is_null($customer)) {
            throw new Exception("Customer no identificado.");
        }

        return true;
    }

    private function getCustomerByEncryption(string $keyEncryption)
    {
        $descryptionMail = $this->decrypt($keyEncryption);
        $customer = $this->getCustomerByMail($descryptionMail);

        if (is_null($customer)) {
            throw new Exception("Customer no identificado.");
        }

        return $customer;
    }

    private function getCustomerArrayByEncryption(string $keyEncryption)
    {
        $customer = $this->getCustomerByEncryption($keyEncryption);
        return $this->entityCustomerArray($customer);
    }

    private function entityCustomerArray(CustomersAccount $customer)
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

    private function validateLoginAccount(string $mail, string $password)
    {
        $customer = $this->getCustomerByMail($mail);

        if ($customer && $customer->password === $this->encryptedPawd($password)) {
            $encryptKey = $this->encrypt($mail);
            $this->setCookie("customer_backend", $encryptKey);

            return ["message" => 'Inicio de sesión exitoso.', "status" => true, 'customer' => $encryptKey];
        }

        return ["message" => 'Credenciales no válidas.', "status" => false];
    }

    public function generatePasswordCustomer(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($body) {
                if (!isset($body["password"])) {
                    throw new Exception("Parametros no validos.");
                }

                return ["password" => $this->encryptedPawd($body["password"])];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function encryptedPawd(string $password)
    {
        return hash_hmac('sha256', $password, env('ENCRYPTION_KEY'));
    }

    private function encrypt($data)
    {
        $iv = str_repeat('0', openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', env('ENCRYPTION_KEY'), 0, $iv);
        return base64_encode($encrypted);
    }

    private function decrypt($data)
    {
        $iv = str_repeat('0', openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted_data = base64_decode($data);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', env('ENCRYPTION_KEY'), 0, $iv);
    }

    public function getInfraestructureData(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $customer = $this->getCustomerByEncryption($header["customer-key"][0]);
                return $this->getInfraestructureDataArray($customer);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getAplicationData(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $customer = $this->getCustomerByEncryption($header["customer-key"][0]);
                return $this->getAplicationDataArray($customer);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getInfraestructureDataArray(CustomersAccount $customer)
    {
        $data = [];

        foreach ($customer->client->indexes as $key => $index) {
            $data[] = array(
                "code" => $index->code,
                "name" => $index->name,
                "search" => $this->convertNumber($index->recentMonthHistoryIndex()->coun() ?? 0),
                "record" => $this->convertNumber($index->recentMonthHistoryQuerySearch()->coun() ?? 0)
            );
        }

        return $data;
    }

    public function getAplicationDataArray(CustomersAccount $customer)
    {
        $data = [];

        $data[] = array(
            "app" => $customer->client->name,
            "code" => $customer->client->code,
            "index" => $customer->client->indexes()->count(),
            "search" => $this->convertNumber($customer->client->recentMonthHistoryQuerySearch()->coun() ?? 0),
            "record" => $this->convertNumber($customer->client->recentMonthHistoryIndex()->sum("count") ?? 0)
        );

        return $data;
    }

    public function getDashboardData(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $customer = $this->getCustomerByEncryption($header["customer-key"][0]);
                return $this->getDataDashboard($customer);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    private function getDataDashboard(CustomersAccount $customer)
    {
        $currentClient = $customer->client;

        return [
            "query" => $this->generateStructureDataBody($currentClient->recentMonthHistoryQuerySearch()),
            "suggestion" => $this->generateStructureSuggestionBody($currentClient->recentMonthHistoryQuerySearchSuggestion()),
            "data" => $this->generateStructureDataIndexes($currentClient)
        ];
    }

    private function generateStructureDataIndexes($currentClient)
    {
        return [
            "index" => $this->getDataIndexDashboard($currentClient),
            "counter" => $this->getCounterDataRecordArray($currentClient->recentMonthHistoryIndex())
        ];
    }

    private function getDataIndexDashboard($currentClient)
    {
        $dataIndex = [];

        foreach ($currentClient->indexes as $index) {
            $dataIndex[] = [
                "code" => $index->code,
                "query" => round($index->recentMonthHistoryQuerySearch()->count()),
                "record" => round($index->recentMonthHistoryIndex()->sum("count"))
            ];
        }

        return $dataIndex;
    }

    private function generateStructureSuggestionBody($collection)
    {
        return ["counter" => $this->getCounterSuggestionDataArray($collection)];
    }

    private function generateStructureDataBody($collection)
    {
        return [
            "counter" => $this->getCounterDataArray($collection),
            "time" => $this->getTimeDataArray($collection)
        ];
    }

    private function generateDateArray()
    {
        $datesArray = [];

        for ($i = 0; $i < 30; $i++) {
            $datesArray[] = Carbon::today()->subDays($i)->toDateString();
        }

        return ["value" => 0, "label" => $datesArray, "data" => []];
    }

    private function getCounterSuggestionDataArray($collection)
    {
        $structure = $this->generateDateArray();

        foreach ($structure["label"] as $date) {
            $newCollection = clone $collection;
            $structure["data"][] = round($newCollection->whereDate("created_at", "=", $date)->count() ?? 0);
        }

        $structure["value"] = $this->convertNumber(array_sum($structure["data"]));
        return $structure;
    }

    private function getCounterDataArray($collection)
    {
        $structure = $this->generateDateArray();

        foreach ($structure["label"] as $date) {
            $newCollection = clone $collection;
            $structure["data"][] = $newCollection->whereDate("created_at", "=", $date)->count() ?? 0;
        }

        $structure["value"] = $this->convertNumber(array_sum($structure["data"]));
        return $structure;
    }

    private function getCounterDataRecordArray($collection)
    {
        $structure = $this->generateDateArray();

        foreach ($structure["label"] as $date) {
            $newCollection = clone $collection;
            $structure["data"][] = round($newCollection->whereDate("created_at", "=", $date)->sum("count") ?? 0);
        }

        $structure["value"] = $this->convertNumber(array_sum($structure["data"]));
        return $structure;
    }

    private function getTimeDataArray($collection)
    {
        $structure = $this->generateDateArray();

        foreach ($structure["label"] as $date) {
            $newCollection = clone $collection;
            $structure["data"][] = round($newCollection->whereDate("created_at", "=", $date)->avg("time_execution") ?? 0);
        }

        $structure["value"] = round(array_sum($structure["data"]) / count($structure["data"]));
        return $structure;
    }

    private function convertNumber($number)
    {
        if ($number < 1000) {
            return $number;
        } elseif ($number < 1000000) {
            return round($number / 1000, 1) . 'K';
        } else {
            return round($number / 1000000, 1) . 'M';
        }
    }
}
