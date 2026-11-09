<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::firstOrCreate(['name' => 'delete-data']);
        Permission::firstOrCreate(['name' => 'view-data']);

        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->syncPermissions(['delete-data', 'view-data']);

        $stafRole = Role::firstOrCreate(['name' => 'Staf']);
        $stafRole->syncPermissions(['view-data']);

        $this->call([
            DemoUserSeeder::class,
            StudentUserSeeder::class,
        ]);
    }
}
