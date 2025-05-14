<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserLevelSeeder::class,
            UserRoleSeeder::class,
            UserSeeder::class,
            EducationSeeder::class,
            MaritalStatusSeeder::class,
        ]);
    }
}
