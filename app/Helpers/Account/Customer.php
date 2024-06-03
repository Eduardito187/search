<?php

namespace App\Helpers\Account;

use App\Helpers\System\CoreHttp;
use App\Models\CustomersAccount;
use Exception;

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
    public function getCustomerInformation(array $body, array $header = [])
    {
        try {
            if (!is_array($header) || !isset($header["customer-key"])) {
                throw new Exception("Parametros no validos.");
            }

            return $this->coreHttp->constructResponse(
                $this->getCustomerByEncryption($header["customer-key"]),
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
     * @return array
     */
    public function getCustomerByEncryption(string $keyEncryption)
    {
        $descryptionMail = $this->decipheredPwd($keyEncryption);
        
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

            if ($customer->password == $encryptPassword) {
                return ["message" => 'Inicio de sesion exitoso.', "status" => true, 'customer' => $this->encryptedPawd($mail)];
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
    public function decipheredPwd(string $password){
        list($encrypted_data, $iv) = explode('::', base64_decode($password), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', env('ENCRYPTION_KEY'), 0, $iv);
    }

    /**
     * @param string $password
     * @return string
     */
    public function encryptedPawd(string $password){
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($password, 'aes-256-cbc', env('ENCRYPTION_KEY'), 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }
}