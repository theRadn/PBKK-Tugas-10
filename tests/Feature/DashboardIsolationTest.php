<?php

use App\Models\Project;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Dashboard Isolation Tests
|--------------------------------------------------------------------------
|
| Memverifikasi bahwa:
|   - User hanya melihat project miliknya di dashboard
|   - Project user lain tidak bocor ke dashboard user lain
|   - Guest tidak dapat mengakses dashboard
|
*/

test('guest diredirect dari dashboard', function () {
    $response = $this->get(route('dashboard'));

    $response->assertRedirect('/login');
})->group('isolation');

test('user melihat projectnya sendiri di dashboard', function () {
    $user = User::factory()->create();
    $projects = Project::factory()->count(3)->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertOk();

    // Setiap judul project milik user harus muncul di halaman
    $projects->each(function (Project $project) use ($response) {
        $response->assertSee($project->judul);
    });
})->group('isolation');

test('user TIDAK melihat project milik user lain', function () {
    $alice = User::factory()->create();
    $bob   = User::factory()->create();

    $aliceProjects = Project::factory()->count(2)->create(['user_id' => $alice->id]);
    $bobProjects   = Project::factory()->count(2)->create(['user_id' => $bob->id]);

    // Alice login → hanya lihat project Alice
    $response = $this->actingAs($alice)->get(route('dashboard'));
    $response->assertOk();

    $aliceProjects->each(function (Project $p) use ($response) {
        $response->assertSee($p->judul);
    });

    $bobProjects->each(function (Project $p) use ($response) {
        $response->assertDontSee($p->judul);
    });
})->group('isolation');

test('dashboard menampilkan jumlah project yang benar', function () {
    $user = User::factory()->create();
    Project::factory()->count(4)->create(['user_id' => $user->id]);

    // User lain punya project juga — tidak boleh ikut terhitung
    $other = User::factory()->create();
    Project::factory()->count(10)->create(['user_id' => $other->id]);

    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertOk();

    // Dashboard menampilkan "4" sebagai Total Project
    $response->assertSee('4');
})->group('isolation');

test('user baru tanpa project melihat empty state', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertOk();
    $response->assertSee('Belum ada project');
})->group('isolation');

test('isolasi antaruser: dua user masing-masing login dan verifikasi', function () {
    $alice = User::factory()->create();
    $bob   = User::factory()->create();

    Project::factory()->count(3)->create(['user_id' => $alice->id]);
    Project::factory()->count(5)->create(['user_id' => $bob->id]);

    // Alice melihat 3 project
    $aliceResponse = $this->actingAs($alice)->get(route('dashboard'));
    $aliceResponse->assertOk();
    $aliceResponse->assertSee('3');

    // Bob melihat 5 project
    $bobResponse = $this->actingAs($bob)->get(route('dashboard'));
    $bobResponse->assertOk();
    $bobResponse->assertSee('5');
})->group('isolation');

test('dashboard menampilkan nama user yang login', function () {
    $user = User::factory()->create(['name' => 'Budi Santoso']);

    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertOk();
    $response->assertSee('Budi Santoso');
})->group('isolation');
