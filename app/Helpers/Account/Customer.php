<?php

namespace App\Helpers\Account;

use App\Helpers\System\CoreHttp;
use App\Models\CustomersAccount;
use Exception;
use Illuminate\Support\Facades\Session;

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
     * @param array $body
     * @param array $header
     * @return array
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
            $this->removeSession("customer_backend");

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
     * @param string $key
     * @return void
     */
    public function removeSession(string $key)
    {
        Session::forget($key);
    }

    /**
     * @param string $key
     * @param string $value
     * @return void
     */
    public function setSession(string $key, string $value)
    {
        Session::put($key, $value);
    }

    /**
     * @param array $body
     * @param array $header
     * @return array
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
                $this->getCustomerByEncryption($header["customer-key"][0]),
                "Proceso ejecutado exitosamente.",
                200,
                true
            );
        } catch (Exception $e) {
            return $this->coreHttp->constructResponse([], $e->getMessage(), 500, false);
        }
    }

    /**
     * @param array $body
     * @param array $header
     * @return array
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
     * @param array $body
     * @param array $header
     * @return array
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
     * @param string $keyEncryption
     * @return bool
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
     * @param string $keyEncryption
     * @return array
     */
    public function getCustomerByEncryption(string $keyEncryption)
    {
        $descryptionMail = $this->decrypt($keyEncryption);
        
        $customer = CustomersAccount::where('mail', $descryptionMail)->first();

        if ($customer == null) {
            throw new Exception("Customer no indentificado.");
        }

        return $this->entityCustomerArray($customer);
    }

    /**
     * @param CustomersAccount $customer
     * @return array
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
     * @param string $mail
     * @param string $password
     * @return array
     */
    public function validateLoginAccount($mail, $password)
    {
        $customer = CustomersAccount::where('mail', $mail)->first();

        if ($customer != null) {
            $encryptPassword = $this->encryptedPawd($password);
            $encryptKey = $this->encrypt($mail);
            $this->setSession("customer_backend", $encryptKey);

            if ($customer->password == $encryptPassword) {
                return ["message" => 'Inicio de sesion exitoso.', "status" => true, 'customer' => $encryptKey];
            } else {
                return ["message" => 'Contraseña erronea.', "status" => false];
            }
        }

        return ["message" => 'El mail no esta asignado a una cuenta.', "status" => false];
    }

    /**
     * @param array $body
     * @param array $header
     * @return array
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
     * @param string $password
     * @return string
     */
    public function encryptedPawd(string $password){
        return hash_hmac('sha256', $password, env('ENCRYPTION_KEY'));
    }

    /**
     * @param string $data
     * @return string
     */
    function encrypt($data)
    {
        $iv = str_repeat('0', openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', env('ENCRYPTION_KEY'), 0, $iv);
        return base64_encode($encrypted);
    }

    /**
     * @param string $data
     * @return string
     */
    function decrypt($data)
    {
        $iv = str_repeat('0', openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted_data = base64_decode($data);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', env('ENCRYPTION_KEY'), 0, $iv);
    }
    
}