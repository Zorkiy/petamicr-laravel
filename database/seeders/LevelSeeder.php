<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Developer', 'description' => 'Розробник проєкту', 'priority' => '1', 'created_at' => now()],
            ['name' => 'SuperAdmin', 'description' => 'Супер адміністратор проєкту', 'priority' => '2', 'created_at' => now()],
            ['name' => 'Admin', 'description' => 'Адміністратор сервіса', 'priority' => '3', 'created_at' => now()],
            ['name' => 'User', 'description' => 'Користувач сервіса', 'priority' => '4', 'created_at' => now()],
            ['name' => 'Viewer', 'description' => 'Переглядач сервіса', 'priority' => '5', 'created_at' => now()],
            ['name' => 'Guest', 'description' => 'Гість', 'priority' => '6', 'created_at' => now()],
        ];

        foreach ($data as $row) {
            if (!DB::table('levels')
                ->where('name', $row['name'])
                ->exists()) {
                DB::table('levels')->insert($row);
            }
        }
    }
}
