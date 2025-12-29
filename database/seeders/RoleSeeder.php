<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Full access to manage users, roles, and posts',
            ],
            [
                'name' => 'editor',
                'display_name' => 'Editor',
                'description' => 'Can manage and publish posts',
            ],
            [
                'name' => 'author',
                'display_name' => 'Author',
                'description' => 'Can write and manage own posts',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}