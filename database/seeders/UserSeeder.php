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
            ['name' => 'Head of Department', 'email' => 'head@example.com', 'role' => 'head', 'password' => Hash::make('password')],
            ['name' => 'Warehouse Keeper', 'email' => 'keeper@example.com', 'role' => 'keeper', 'password' => Hash::make('password')],
            ['name' => 'Employee User 1', 'email' => 'employee1@example.com', 'role' => 'employee', 'password' => Hash::make('password')],
            ['name' => 'Employee User 2', 'email' => 'employee2@example.com', 'role' => 'employee', 'password' => Hash::make('password')],
            ['name' => 'Employee User 3', 'email' => 'employee3@example.com', 'role' => 'employee', 'password' => Hash::make('password')],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
