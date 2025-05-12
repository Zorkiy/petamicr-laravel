<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignInitialLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            1 => 1,
            2 => 4,
        ];

        foreach ($users as $userId => $levelId) {
            $user = User::find($userId);
            if ($user) {
                $user->level_id = $levelId;
                $user->save();
            }
        }
    }
}
