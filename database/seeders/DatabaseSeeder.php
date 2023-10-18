<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            PositionSeeder::class,
            UsersSeeder::class,
            PermissionsSeeder::class,
            RolesSeeder::class,
            PermissionRoleSeeder::class,
            RoleUserSeeder::class,
        ]);
    }
}
