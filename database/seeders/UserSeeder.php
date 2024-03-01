<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'abdul.arif',
            'email' => 'abdul.arif@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('asdasd'),
            'roles' => 'observer',
        ]);
        User::factory()->create([
            'username' => 'stageof.balikpapan',
            'email' => 'stageof.balikpapan@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('asdasd'),
            'roles' => 'admin',
        ]);
        User::factory(10)->create();
    }
}
