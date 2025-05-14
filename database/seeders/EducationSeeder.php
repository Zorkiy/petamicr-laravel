<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Education;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Середня',
            'Базова вища',
            'Неповна вища',
            'Повна вища',
        ];

        foreach ($data as $name) {
            Education::firstOrCreate(['name' => $name]);
        }
    }
}
