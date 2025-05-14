<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['user_id' => 1, 'role_id' => 2],
            ['user_id' => 2, 'role_id' => 1],
        ];

        foreach ($data as $row) {
            if (!DB::table('role_user')
                ->where('user_id', $row['user_id'])
                ->where('role_id', $row['role_id'])
                ->exists()) {
                DB::table('role_user')->insert($row);
            }
        }
    }
}
