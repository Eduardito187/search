<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SystemToken;
use Illuminate\Support\Facades\DB;

class TokenSystem extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (SystemToken::count() == 0) {
            DB::table("system_token")->insert([
                "id" => 1,
                "name" => "System",
                "token" => "heMeo8djbymQCSRTwggdTwWDV0M2pCCS",
                "status" => true,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => null
            ]);
        }
    }
}