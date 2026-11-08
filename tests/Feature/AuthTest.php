<?php

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Authentication Tests
|--------------------------------------------------------------------------
|
| Menguji alur autentikasi lengkap:
|   - Halaman login & register dapat diakses
|   - Register membuat user dan redirect ke dashboard
|   - Login berhasil dengan kredensial benar
|   - Login gagal dengan kredensial salah
|   - Logout menghapus session
|
*/

test('halaman login dapat diakses', function () {
    $response = $this->get(route('login.form'));

    $response->assertOk();
    $response->assertSee('Masuk ke Akun');
})->group('auth');

test('halaman register dapat diakses', function () {
    $response = $this->get(route('register.form'));

    $response->assertOk();
    $response->assertSee('Buat Akun Baru');
})->group('auth');

test('register berhasil membuat user baru dan redirect ke dashboard', function () {
    $response = $this->post(route('register'), [
        'name'                  => 'Mahasiswa Baru',
        'email'                 => 'mahasiswabaru@its.ac.id',
        'password'              => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect(route('dashboard'));

    $this->assertDatabaseHas('users', [
        'email' => 'mahasiswabaru@its.ac.id',
        'name'  => 'Mahasiswa Baru',
    ]);

    $this->assertAuthenticated();
})->group('auth');

test('register gagal jika email sudah terdaftar', function () {
    User::factory()->create(['email' => 'existing@its.ac.id']);

    $response = $this->post(route('register'), [
        'name'                  => 'Another User',
        'email'                 => 'existing@its.ac.id',
        'password'              => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertSessionHasErrors('email');
})->group('auth');

test('login berhasil dengan kredensial yang benar', function () {
    $user = User::factory()->create([
        'password' => bcrypt('rahasia123'),
    ]);

    $response = $this->post(route('login'), [
        'email'    => $user->email,
        'password' => 'rahasia123',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticatedAs($user);
})->group('auth');

test('login gagal dengan password salah', function () {
    $user = User::factory()->create([
        'password' => bcrypt('rahasia123'),
    ]);

    $response = $this->post(route('login'), [
        'email'    => $user->email,
        'password' => 'salah_password',
    ]);

    $this->assertGuest();
})->group('auth');

test('logout berhasil menghapus session', function () {
    $user = User::factory()->create();

    $this->actingAs($user);
    $this->assertAuthenticated();

    $response = $this->post(route('logout'));

    $response->assertRedirect('/');
    $this->assertGuest();
})->group('auth');

test('user yang sudah login tidak bisa akses halaman login', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('login.form'));

    $response->assertRedirect();
})->group('auth');

test('user yang sudah login tidak bisa akses halaman register', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('register.form'));

    $response->assertRedirect();
})->group('auth');
