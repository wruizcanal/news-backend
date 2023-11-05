<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role = new Role();
        $admin_role->name = config('site.default_roles.webmaster_role');
        $admin_role->guard_name = 'web';
        $admin_role->save();

        $admin_permissions_id = Permission::all('id');

        $admin_role->permissions()->attach($admin_permissions_id);
        $admin_role->save();

        $basic_role = new Role();
        $basic_role->name = config('site.default_roles.basic_role');
        $basic_role->guard_name = 'web';
        $basic_role->save();

        $basic_permissions_id = Permission::query()->where('name', 'dashboard')->get('id');

        $basic_role->permissions()->attach($basic_permissions_id);
        $basic_role->save();
    }
}
