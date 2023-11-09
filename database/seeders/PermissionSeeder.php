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

            // Authors Permissions
            'author-list' => 'web',
            'author-create' => 'web',
            'author-edit' => 'web',
            'author-delete' => 'web',

            // Categories Permissions
            'category-list' => 'web',
            'category-create' => 'web',
            'category-edit' => 'web',
            'category-delete' => 'web',

            // Comments Permissions
            'comment-list' => 'web',
            'comment-create' => 'web',
            'comment-edit' => 'web',
            'comment-delete' => 'web',

            // Gallery Permissions
            'gallery-list' => 'web',
            'gallery-create' => 'web',
            'gallery-edit' => 'web',
            'gallery-delete' => 'web',

            // Multimedias Permissions
            'multimedia-list' => 'web',
            'multimedia-create' => 'web',
            'multimedia-edit' => 'web',
            'multimedia-delete' => 'web',

            // News Permissions
            'news-list' => 'web',
            'news-create' => 'web',
            'news-edit' => 'web',
            'news-delete' => 'web',

        ];

        foreach ($permissions as $name => $guard_name) {
            DB::table('permissions')->insert([
                'guard_name' => $guard_name,
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
