<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'SergSV', 'email' => 'vladimirovichser@gmail.com', 'password' => Hash::make('nBwQ7ZrrTfAkNJX')],
            ['name' => 'Juliya', 'email' => 'yuliyaburyanenko@gmail.com', 'password' => Hash::make('121010#Secret')],
        ];

        foreach ($data as $row) {
            if (!DB::table('users')
                ->where('name', $row['name'])
                ->exists()) {
                DB::table('users')->insert($row);
            }
        }
    }
}
