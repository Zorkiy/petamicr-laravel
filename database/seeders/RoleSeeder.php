<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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

        foreach ($data as $edu_data) {
            Role::firstOrCreate(['name' => $edu_data['name']], $edu_data);
        }
    }
}
