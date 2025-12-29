<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole && !$admin->roles()->where('name', 'admin')->exists()) {
            $admin->roles()->attach($adminRole->id);
        }

        // EDITOR
        $editor = User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Editor User',
                'password' => Hash::make('password'),
            ]
        );

        $editorRole = Role::where('name', 'editor')->first();
        if ($editorRole && !$editor->roles()->where('name', 'editor')->exists()) {
            $editor->roles()->attach($editorRole->id);
        }

        // AUTHOR
        $author = User::firstOrCreate(
            ['email' => 'author@example.com'],
            [
                'name' => 'Author User',
                'password' => Hash::make('password'),
            ]
        );

        $authorRole = Role::where('name', 'author')->first();
        if ($authorRole && !$author->roles()->where('name', 'author')->exists()) {
            $author->roles()->attach($authorRole->id);
        }
    }
}