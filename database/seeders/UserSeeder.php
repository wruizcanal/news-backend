<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_user = new User();
        $admin_user->name = 'Admin User';
        $admin_user->email = 'admin@news.test';
        $admin_user->password = Hash::make('admin123');
        $admin_user->save();

        $admin_role_id = Role::query()->where('name', config('site.default_roles.webmaster_role'))->first('id');

        $admin_user->roles()->attach($admin_role_id);
        $admin_user->markEmailAsVerified();
        $admin_user->save();

        $test_user = new User();
        $test_user->name = 'Test User';
        $test_user->email = 'user@news.test';
        $test_user->password = Hash::make('user123');
        $test_user->save();

        $test_role_id = Role::query()->where('name', config('site.default_roles.basic_role'))->first('id');

        $test_user->roles()->attach($test_role_id);
        $test_user->markEmailAsVerified();
        $test_user->save();
    }
}
