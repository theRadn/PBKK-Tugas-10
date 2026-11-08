<?php

use App\Models\Project;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Project Ownership / Kontrak Antar-Modul
|--------------------------------------------------------------------------
|
| Memverifikasi kontrak kepemilikan:
|   - User hasMany Project
|   - Project belongsTo User
|   - Foreign key constraint terjaga
|
*/

test('user memiliki relasi hasMany ke projects', function () {
    $user = User::factory()->create();
    Project::factory()->count(3)->create(['user_id' => $user->id]);

    expect($user->projects)->toHaveCount(3);
    expect($user->projects->first())->toBeInstanceOf(Project::class);
})->group('ownership');

test('project memiliki relasi belongsTo ke user', function () {
    $user = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $user->id]);

    expect($project->user)->toBeInstanceOf(User::class);
    expect($project->user->id)->toBe($user->id);
})->group('ownership');

test('project wajib dimiliki oleh user (user_id required)', function () {
    // Membuat project tanpa user_id harus gagal
    expect(fn () => Project::factory()->create(['user_id' => null]))
        ->toThrow(\Illuminate\Database\QueryException::class);
})->group('ownership');

test('project tidak bisa mereferensi user yang tidak ada', function () {
    expect(fn () => Project::factory()->create(['user_id' => 99999]))
        ->toThrow(\Illuminate\Database\QueryException::class);
})->group('ownership');

test('menghapus user otomatis menghapus semua projectnya (cascade)', function () {
    $user = User::factory()->create();
    $projectIds = Project::factory()->count(5)->create(['user_id' => $user->id])->pluck('id');

    $user->delete();

    $projectIds->each(function ($id) {
        expect(Project::find($id))->toBeNull();
    });
})->group('ownership');

test('project hanya dimiliki satu user', function () {
    $userA = User::factory()->create();
    $userB = User::factory()->create();

    $project = Project::factory()->create(['user_id' => $userA->id]);

    expect($project->user->id)->toBe($userA->id);
    expect($project->user->id)->not->toBe($userB->id);
})->group('ownership');

test('user tanpa project mengembalikan collection kosong', function () {
    $user = User::factory()->create();

    expect($user->projects)->toBeEmpty();
    expect($user->projects)->toHaveCount(0);
})->group('ownership');

test('project fillable fields terdaftar dengan benar', function () {
    $project = new Project();

    expect($project->getFillable())->toContain('user_id');
    expect($project->getFillable())->toContain('judul');
    expect($project->getFillable())->toContain('deskripsi');
    expect($project->getFillable())->toContain('tema_agent');
    expect($project->getFillable())->toContain('api_key_secure');
})->group('ownership');
