<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Helsi', 'description' => 'Доступ до Helsi сервісів'],
            ['name' => 'VOHOR', 'description' => 'Доступ до VOHOR сервісів'],
        ];

        foreach ($data as $elem) {
            UserRole::firstOrCreate(['name' => $elem['name']], $elem);
        }
    }
}
