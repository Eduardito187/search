<?php

namespace App\Helpers\System;

use Exception;
use App\Models\Ip;
use App\Models\Config;
use App\Models\Migrations;
use App\Models\RestrictIp;
use App\Models\RestrictDomain;

class Core
{
    public function __construct() {
    }

    /**
     * @return Ip[]
     */
    public function getAllIp()
    {
        return Ip::all();
    }

    /**
     * @return Config[]
     */
    public function getAllConfig()
    {
        return Config::all();
    }

    /**
     * @return Migrations[]
     */
    public function getAllMigrations()
    {
        return Migrations::all();
    }

    /**
     * @return RestrictIp[]
     */
    public function getAllRestrictIp()
    {
        return RestrictIp::all();
    }

    /**
     * @return RestrictDomain[]
     */
    public function getAllRestrictDomain()
    {
        return RestrictDomain::all();
    }

    /**
     * @return bool
     */
    public function isValidIp($ip)
    {
        return !RestrictIp::where('ip', $ip)->where('status', true)->exists();
    }
}