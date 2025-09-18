<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin User',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        User::create([
            'name' => 'professor User',
            'email' => 'professor@professor.com',
            'role' => 'professor',
            'password' => bcrypt('professor123'),
        ]);
    }
}
