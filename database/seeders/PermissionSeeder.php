<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // 'name' => 'guard_name'
            // Dashboard Permission
            'dashboard' => 'web',

            // Users Permissions
            'user-list' => 'web',
            'user-create' => 'web',
            'user-edit' => 'web',
            'user-delete' => 'web',

            // Roles Permissions
            'role-list' => 'web',
            'role-create' => 'web',
            'role-edit' => 'web',
            'role-delete' => 'web',

        ];

        foreach ($permissions as $name => $guard_name) {
            DB::table('permissions')->insert([
                'guard_name' => $guard_name,
                'name' => $name,
            ]);
        }
    }
}
