<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config as ModelConfig;
use Illuminate\Support\Facades\DB;
use App\Helpers\Base\Tools;

class ConfigBaseFrontend extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!ModelConfig::where('code', 'token_access_frontend')->exists()) {
            DB::table("config")->insert([
                'id' => null,
                'code' => 'token_access_frontend',
                'value' => Tools::generateTokenFrontendRandom(),
                'status' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at	' => null
            ]);
        }

        if (!ModelConfig::where('code', 'base_url_frontend')->exists()) {
            DB::table("config")->insert([
                'id' => null,
                'code' => 'base_url_frontend',
                'value' => 'https://search.grazcompany.com/',
                'status' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at	' => null
            ]);
        }

        if (!ModelConfig::where('code', 'version_frontend')->exists()) {
            DB::table("config")->insert([
                'id' => null,
                'code' => 'version_frontend',
                'value' => 'V 1.0.0',
                'status' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at	' => null
            ]);
        }

        if (!ModelConfig::where('code', 'app_name_frontend')->exists()) {
            DB::table("config")->insert([
                'id' => null,
                'code' => 'app_name_frontend',
                'value' => 'EduardSearch',
                'status' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at	' => null
            ]);
        }

        if (!ModelConfig::where('code', 'copyright_frontend')->exists()) {
            DB::table("config")->insert([
                'id' => null,
                'code' => 'copyright_frontend',
                'value' => 'EduardSearch ©',
                'status' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at	' => null
            ]);
        }

        if (!ModelConfig::where('code', 'environment_frontend')->exists()) {
            DB::table("config")->insert([
                'id' => null,
                'code' => 'environment_frontend',
                'value' => 'EduardSearch',
                'status' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at	' => null
            ]);
        }
    }
}