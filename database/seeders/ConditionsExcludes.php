<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ConditionsExcludes as ModelConditionsExcludes;
use Illuminate\Support\Facades\DB;

class ConditionsExcludes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (ModelConditionsExcludes::count() == 0) {
            DB::table("conditions_excludes")->insert([
                "id" => 1,
                "name" => "Greater Than",
                "code" => "greater than",
                "status" => true,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => null
            ]);
            DB::table("conditions_excludes")->insert([
                "id" => 2,
                "name" => "Greater",
                "code" => "greater",
                "status" => true,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => null
            ]);
            DB::table("conditions_excludes")->insert([
                "id" => 3,
                "name" => "Smaller Than",
                "code" => "smaller than",
                "status" => true,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => null
            ]);
            DB::table("conditions_excludes")->insert([
                "id" => 4,
                "name" => "Smaller",
                "code" => "smaller",
                "status" => true,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => null
            ]);
            DB::table("conditions_excludes")->insert([
                "id" => 5,
                "name" => "Equal",
                "code" => "equal",
                "status" => true,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => null
            ]);
        }
    }
}