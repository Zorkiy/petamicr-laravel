<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['login' => 'SergSV', 'email' => 'vladimirovichser@gmail.com', 'password' => Hash::make('nBwQ7ZrrTfAkNJX')],
            ['login' => 'Juliya', 'email' => 'yuliyaburyanenko@gmail.com', 'password' => Hash::make('121010#Secret')],
        ];

        foreach ($data as $elem) {
            User::firstOrCreate(['login' => $elem['login']], $elem);
        }
    }
}
