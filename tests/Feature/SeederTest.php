<?php

use App\Models\Project;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\DemoUserSeeder;
use Database\Seeders\StudentUserSeeder;

/*
|--------------------------------------------------------------------------
| Seeder Tests
|--------------------------------------------------------------------------
|
| Memverifikasi bahwa seeder menghasilkan jumlah data yang benar
| sesuai spesifikasi:
|   - DemoUserSeeder  → 1 user  + 4 project
|   - StudentUserSeeder → 15 user + 30 project (2 per user)
|   - DatabaseSeeder  → total 16 user + 34 project
|
*/

test('DemoUserSeeder membuat user dosenpbkk@its.ac.id', function () {
    $this->seed(DemoUserSeeder::class);

    $demo = User::where('email', 'dosenpbkk@its.ac.id')->first();

    expect($demo)->not->toBeNull();
    expect($demo->name)->toBe('Daniel Morgan');
    expect($demo->email_verified_at)->not->toBeNull();
})->group('seeder');

test('DemoUserSeeder membuat 4 project untuk user demo', function () {
    $this->seed(DemoUserSeeder::class);

    $demo = User::where('email', 'dosenpbkk@its.ac.id')->first();

    expect($demo->projects()->count())->toBe(4);
})->group('seeder');

test('StudentUserSeeder membuat 15 user mahasiswa', function () {
    $this->seed(StudentUserSeeder::class);

    // StudentUserSeeder membuat 15 user via factory
    expect(User::count())->toBe(15);
})->group('seeder');

test('StudentUserSeeder membuat 2 project per mahasiswa', function () {
    $this->seed(StudentUserSeeder::class);

    $users = User::all();

    $users->each(function (User $user) {
        expect($user->projects()->count())->toBe(2);
    });

    // Total 15 × 2 = 30 project
    expect(Project::count())->toBe(30);
})->group('seeder');

test('DatabaseSeeder menghasilkan total 16 user dan 34 project', function () {
    $this->seed(DatabaseSeeder::class);

    // 1 demo + 15 student = 16
    expect(User::count())->toBe(16);

    // 4 (demo) + 30 (students) = 34
    expect(Project::count())->toBe(34);
})->group('seeder');

test('DemoUserSeeder bersifat idempotent (updateOrCreate)', function () {
    // Jalankan 2 kali — user tetap 1
    $this->seed(DemoUserSeeder::class);
    $this->seed(DemoUserSeeder::class);

    expect(User::where('email', 'dosenpbkk@its.ac.id')->count())->toBe(1);
})->group('seeder');

test('setiap project hasil seeder memiliki judul dan api_key_secure', function () {
    $this->seed(DatabaseSeeder::class);

    Project::all()->each(function (Project $project) {
        expect($project->judul)->not->toBeEmpty();
        expect($project->api_key_secure)->not->toBeEmpty();
    });
})->group('seeder');
