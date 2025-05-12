<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        foreach ($data as $row) {
            if (!DB::table('roles')
                ->where('name', $row['name'])
                ->exists()) {
                DB::table('roles')->insert($row);
            }
        }
    }
}
