<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(ConditionsExcludes::class);
        $this->call(ConfigBaseFrontend::class);
        $this->call(SortingType::class);
        $this->call(TokenSystem::class);
        $this->call(TypeAttributes::class);
        $this->call(EventSections::class);
    }
}
