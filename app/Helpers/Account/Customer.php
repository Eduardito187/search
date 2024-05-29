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

    public function validateLoginAccount($mail, $password)
    {
        $customer = CustomersAccount::where('mail', $mail)->first();

        if ($customer != null) {
            $encryptPassword = $this->encriptionPawd($password);

            if ($customer->password == $encryptPassword) {
                return ["message" => 'Inicio de sesion exitoso.', "status" => true, 'customer' => $this->encriptionPawd($mail)];
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
                    "password" => $this->encriptionPawd($body["password"])
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
    public function encriptionPawd(string $password){
        return hash_hmac('sha256', $password, env('ENCRYPTION_KEY'));
    }
}