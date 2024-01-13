<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Admin User', 'email' => 'admin@example.com', 'role' => 'admin', 'password' => Hash::make('password')],
            ['name' => 'Manager User', 'email' => 'manager@example.com', 'role' => 'manager', 'password' => Hash::make('password')],
            ['name' => 'Employee User', 'email' => 'employee@example.com', 'role' => 'employee', 'password' => Hash::make('password')],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
