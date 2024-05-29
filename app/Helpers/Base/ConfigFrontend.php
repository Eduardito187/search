<?php

namespace App\Helpers\Base;

use App\Models\Config;

class ConfigFrontend
{
    const TOKEN_ACCESS_FRONTEND = 'token_access_frontend';
    const BASE_URL_FRONTEND = 'base_url_frontend';
    const VERSION_FRONTEND = 'version_frontend';
    const APP_NAME_FRONTEND = 'app_name_frontend';
    const COPYRIGHT_FRONTEND = 'copyright_frontend';
    const ENVIRONMENT_FRONTEND = 'environment_frontend';

    /**
     * Constructor ConfigFrontend
     */
    public function __construct()
    {
    }

    /**
     * @return array
     */
    public function getConfigFrontend()
    {
        return [
            self::TOKEN_ACCESS_FRONTEND => $this->getValueConfig(self::TOKEN_ACCESS_FRONTEND),
            self::BASE_URL_FRONTEND => $this->getValueConfig(self::BASE_URL_FRONTEND),
            self::VERSION_FRONTEND => $this->getValueConfig(self::VERSION_FRONTEND),
            self::APP_NAME_FRONTEND => $this->getValueConfig(self::APP_NAME_FRONTEND),
            self::COPYRIGHT_FRONTEND => $this->getValueConfig(self::COPYRIGHT_FRONTEND),
            self::ENVIRONMENT_FRONTEND => $this->getValueConfig(self::ENVIRONMENT_FRONTEND)
        ];
    }

    /**
     * @param string $codeConfig
     * @return string
     */
    public function getValueConfig($codeConfig)
    {
        $valueConfig = Config::where('code', $codeConfig)->where('status', true)->first();

        if ($valueConfig) {
            return $valueConfig->value;
        }

        return '';
    }
}