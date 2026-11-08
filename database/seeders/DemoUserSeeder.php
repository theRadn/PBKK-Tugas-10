<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        // Local/demo password only.
        $demo = User::updateOrCreate(
            ['email' => 'dosenpbkk@its.ac.id'],
            [
                'name' => 'Daniel Morgan',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        if (class_exists(ProjectFactory::class)) {
            Project::factory()->count(4)->create(['user_id' => $demo->id]);
        }
    }
}
