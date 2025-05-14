<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ['name' => 'Середня'],
            ['name' => 'Базова вища'],
            ['name' => 'Неповна вища'],
            ['name' => 'Повна вища'],
        ];

        foreach ($data as $edu_data) {
            Education::firstOrCreate(['name' => $edu_data['name']], $edu_data);
        }
    }
}
