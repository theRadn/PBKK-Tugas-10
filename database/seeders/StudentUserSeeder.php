<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Seeder;

class StudentUserSeeder extends Seeder
{
    public function run(): void
    {
        $students = User::factory()->count(15)->create();

        if (class_exists(ProjectFactory::class)) {
            $students->each(fn (User $user) => Project::factory()->count(2)->create(['user_id' => $user->id]));
        }
    }
}
