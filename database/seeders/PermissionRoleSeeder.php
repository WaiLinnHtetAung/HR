<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_permissions = Permission::pluck('name');
        Role::findOrFail(1)->givePermissionTo($admin_permissions);

        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission, 0, 5) != 'user_' && substr($permission, 0, 5) != 'role_' && substr($permission, 0, 11) != 'permission_' && $permission != 'department_create' && $permission != 'department_edit' && $permission != 'department_delete' && $permission != 'position_create' && $permission != 'position_edit' && $permission != 'position_delete' && $permission != 'company_edit' && $permission != 'attendance_create' && $permission != 'attendance_edit' && $permission != 'attendance_delete';
        });

        Role::findOrFail(2)->givePermissionTo($user_permissions);
    }
}