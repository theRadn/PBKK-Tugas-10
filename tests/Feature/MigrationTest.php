<?php

use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Migration Tests
|--------------------------------------------------------------------------
|
| Memastikan semua tabel dan kolom yang diperlukan terbentuk saat
| migration dijalankan.  Setiap test diberi label `migration`.
|
*/

test('tabel users memiliki semua kolom yang benar', function () {
    expect(Schema::hasTable('users'))->toBeTrue();

    $columns = ['id', 'name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'];

    foreach ($columns as $col) {
        expect(Schema::hasColumn('users', $col))
            ->toBeTrue("Kolom '{$col}' seharusnya ada di tabel users");
    }
})->group('migration');

test('tabel projects memiliki semua kolom yang benar', function () {
    expect(Schema::hasTable('projects'))->toBeTrue();

    $columns = ['id', 'user_id', 'judul', 'deskripsi', 'tema_agent', 'api_key_secure', 'created_at', 'updated_at'];

    foreach ($columns as $col) {
        expect(Schema::hasColumn('projects', $col))
            ->toBeTrue("Kolom '{$col}' seharusnya ada di tabel projects");
    }
})->group('migration');

test('tabel sessions terbentuk', function () {
    expect(Schema::hasTable('sessions'))->toBeTrue();

    $columns = ['id', 'user_id', 'ip_address', 'user_agent', 'payload', 'last_activity'];

    foreach ($columns as $col) {
        expect(Schema::hasColumn('sessions', $col))
            ->toBeTrue("Kolom '{$col}' seharusnya ada di tabel sessions");
    }
})->group('migration');

test('tabel password_reset_tokens terbentuk', function () {
    expect(Schema::hasTable('password_reset_tokens'))->toBeTrue();

    $columns = ['email', 'token', 'created_at'];

    foreach ($columns as $col) {
        expect(Schema::hasColumn('password_reset_tokens', $col))
            ->toBeTrue("Kolom '{$col}' seharusnya ada di tabel password_reset_tokens");
    }
})->group('migration');

test('tabel cache terbentuk', function () {
    expect(Schema::hasTable('cache'))->toBeTrue();
})->group('migration');

test('tabel jobs terbentuk', function () {
    expect(Schema::hasTable('jobs'))->toBeTrue();
})->group('migration');

test('tabel personal_access_tokens terbentuk', function () {
    expect(Schema::hasTable('personal_access_tokens'))->toBeTrue();
})->group('migration');

test('projects.user_id adalah foreign key ke users', function () {
    // Buat user lalu project → harus berhasil
    $user = \App\Models\User::factory()->create();
    $project = \App\Models\Project::factory()->create(['user_id' => $user->id]);

    expect($project->exists)->toBeTrue();
    expect($project->user_id)->toBe($user->id);
})->group('migration');

test('foreign key cascade: hapus user maka projects ikut terhapus', function () {
    $user = \App\Models\User::factory()->create();
    \App\Models\Project::factory()->count(3)->create(['user_id' => $user->id]);

    expect(\App\Models\Project::where('user_id', $user->id)->count())->toBe(3);

    $user->delete();

    expect(\App\Models\Project::where('user_id', $user->id)->count())->toBe(0);
})->group('migration');
