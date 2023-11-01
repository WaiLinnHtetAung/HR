<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'user_management_access',
            ],
            [
                'name' => 'permission_create',
            ],
            [
                'name' => 'permission_edit',
            ],
            [
                'name' => 'permission_show',
            ],
            [
                'name' => 'permission_delete',
            ],
            [
                'name' => 'permission_access',
            ],
            [
                'name' => 'role_create',
            ],
            [
                'name' => 'role_edit',
            ],
            [
                'name' => 'role_show',
            ],
            [
                'name' => 'role_delete',
            ],
            [
                'name' => 'role_access',
            ],
            [
                'name' => 'user_create',
            ],
            [
                'name' => 'user_edit',
            ],
            [
                'name' => 'user_show',
            ],
            [
                'name' => 'user_delete',
            ],
            [
                'name' => 'user_access',
            ],
            [
                'name' => 'office_management',
            ],
            [
                'name' => 'department_create',
            ],
            [
                'name' => 'department_edit',
            ],
            [
                'name' => 'department_show',
            ],
            [
                'name' => 'department_delete',
            ],
            [
                'name' => 'department_access',
            ],
            [
                'name' => 'position_create',
            ],
            [
                'name' => 'position_edit',
            ],
            [
                'name' => 'position_show',
            ],
            [
                'name' => 'position_delete',
            ],
            [
                'name' => 'position_access',
            ],
            [
                'name' => 'company_access',
            ],
            [
                'name' => 'company_edit',
            ],
            [
                'name' => 'company_show',
            ],
            [
                'name' => 'attendance_management_access',
            ],
            [
                'name' => 'attendance_create',
            ],
            [
                'name' => 'attendance_edit',
            ],
            [
                'name' => 'attendance_show',
            ],
            [
                'name' => 'attendance_delete',
            ],
            [
                'name' => 'attendance_access',
            ],
            [
                'name' => 'attendance_overview_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
