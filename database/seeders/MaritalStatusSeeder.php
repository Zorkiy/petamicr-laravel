<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Seeder;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Перебуває у шлюбі',
            'Не перебуває у шлюбі',
            'У цивільному шлюбі',
            'Вдівець/вдова',
        ];

        foreach ($data as $name) {
            MaritalStatus::firstOrCreate(['name' => $name]);
        }
    }
}
