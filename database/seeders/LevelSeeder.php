<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Developer', 'description' => 'Розробник проєкту', 'priority' => 1],
            ['name' => 'SuperAdmin', 'description' => 'Супер адміністратор проєкту', 'priority' => 2],
            ['name' => 'Admin', 'description' => 'Адміністратор сервіса', 'priority' => 3],
            ['name' => 'User', 'description' => 'Користувач сервіса', 'priority' => 4],
            ['name' => 'Viewer', 'description' => 'Переглядач сервіса', 'priority' => 5],
            ['name' => 'Guest', 'description' => 'Гість', 'priority' => 6],
        ];

        foreach ($data as $level_data) {
            Level::firstOrCreate(['name' => $level_data['name']], $level_data);
        }
    }
}
