<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'Admin'
        ]);
        User::create([
            'name' => 'Employee',
            'email' => 'employee@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'Employee'
        ]);
        User::create([
            'name' => 'Store Executive',
            'email' => 'store.executive@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'Store Executive'
        ]);
    }
}
