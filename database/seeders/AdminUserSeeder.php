<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Profile
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@logoscoffe.com'],
            [
                'name' => 'Admin Logos',
                'password' => \Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Cashier Profile
        \App\Models\User::updateOrCreate(
            ['email' => 'cashier@logoscoffe.com'],
            [
                'name' => 'Cashier Logos',
                'password' => \Hash::make('password'),
                'role' => 'cashier',
            ]
        );

        // Owner Profile
        \App\Models\User::updateOrCreate(
            ['email' => 'owner@logoscoffe.com'],
            [
                'name' => 'Owner Logos',
                'password' => \Hash::make('password'),
                'role' => 'owner',
            ]
        );
    }
}