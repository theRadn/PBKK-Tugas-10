<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Import Hash
use Spatie\Permission\Models\Role;

class StudentUserSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure Staf role exists
        $stafRole = Role::firstOrCreate(['name' => 'Staf']);

        $demoStudent = User::updateOrCreate(
            ['email' => 'mahasiswa@its.ac.id'],
            [
                'name' => 'Budi Santoso (Mahasiswa)',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $demoStudent->assignRole($stafRole);

        if (class_exists(ProjectFactory::class)) {
            // Seed exactly 12 projects for the main demo student
            Project::factory()->count(12)->create(['user_id' => $demoStudent->id]);
        }

        $randomStudents = User::factory()->count(15)->create();

        if (class_exists(ProjectFactory::class)) {
            $randomStudents->each(function (User $user) use ($stafRole) {
                $user->assignRole($stafRole);

                Project::factory()->count(2)->create(['user_id' => $user->id]);
            });
        }
    }
}
