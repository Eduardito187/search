<?php

namespace App\Helpers\System;

use App\Models\IndexConfiguration;
use Exception;
use App\Models\AutorizationToken;
use App\Helpers\Text\Translate;
use App\Models\RestrictDomain;
use App\Models\SystemToken;

class CoreHttp
{
    /**
     * @var Translate
     */
    protected $translate;

    /**
     * @var array
     */
    public $responseApi = [];

    public function __construct() {
        $this->translate = new Translate();
    }

    public function constructResponse($response, $responseText = "", $code = 500, $status = false)
    {
        return array(
            "response" => $response,
            "responseText" => $responseText,
            "code" => $code,
            "status" => $status
        );
    }

    /**
     * @inheritDoc
     */
    public function constructResponseProcess($type, $sku)
    {
        $this->responseApi[] = array("type" => $type, "sku" => $sku, "timestamp" => date("Y-m-d H:i:s"));
    }

    /**
     * @param string $domain
     * @return bool
     */
    public function restrictDoamin(string $domain)
    {
        return RestrictDomain::where('domain', $domain)->where('status', true)->exists();
    }

    /**
     * @param string $apiKey
     * @return bool
     */
    public function existApiKey(string $apiKey)
    {
        return IndexConfiguration::where('api_key', $apiKey)->where('status', true)->exists();
    }

    /**
     * @param string $apiKey
     * @return bool
     */
    public function existApiKeyAll(string $apiKey)
    {
        return IndexConfiguration::where('api_key', $apiKey)->exists();
    }

    /**
     * @param array $headers
     */
    public function validateApiKey($headers, $all = false)
    {
        if (!array_key_exists("api-key", $headers)) {
            throw new Exception("No existe api-key.");
        }

        if (count($headers["api-key"]) == 0) {
            throw new Exception("El api-key esta vacio.");
        }

        if ($all) {
            if (!$this->existApiKeyAll($headers["api-key"][0])) {
                throw new Exception("El Api-Key no se encuentra asignado a un indice.");
            }
        } else {
            if (!$this->existApiKey($headers["api-key"][0])) {
                throw new Exception("El indice perteneciente al Api-Key se encuentra desactivado.");
            }
        }
    }

    /**
     * @return string|null
     */
    public function getToken($token)
    {
        if ($token == null) {
            return null;
        }

        $token = explode($this->translate->getSpace(), $token);

        if (count($token) == 2) {
            return $token[1];
        } else {
            return null;
        }
    }

    /**
     * @return bool
     */
    public function isValidToken($token)
    {
        $token = $this->getToken($token);

        if ($token == null) {
            return false;
        }

        return AutorizationToken::where('token', $token)->where('status', true)->exists();
    }

    /**
     * @return bool
     */
    public function isValidAdminToken($token)
    {
        $token = $this->getToken($token);

        if ($token == null) {
            return false;
        }

        return SystemToken::where('token', $token)->where('status', true)->exists();
    }

    /**
     * @return string
     */
    public function getTokenRequest($header)
    {
        $authorization = $header["authorization"];

        if (count($authorization) == 0) {
            throw new Exception("Error en autorización.");
        }

        $token = $this->getToken($authorization[0]);

        if ($token == null) {
            throw new Exception("Error en autorización.");
        }

        return $token;
    }

    /**
     * @return bool
     */
    public function validateTokenRequest($header)
    {
        $authorization = $header["authorization"];

        if (count($authorization) == 0) {
            throw new Exception("Error en autorización.");
        }

        $token = $this->getToken($authorization[0]);

        if ($token == null) {
            throw new Exception("Error en autorización.");
        }

        return AutorizationToken::where('token', $token)->where('status', true)->exists();
    }

    public function getClientToken($token)
    {
        return AutorizationToken::where('token', $token)->where('status', true)->first();
    }
}
