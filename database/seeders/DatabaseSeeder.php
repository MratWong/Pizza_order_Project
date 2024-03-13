<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '09251477902',
            'address' => 'Rakhine',
            'role' => 'admin',
            'gender' => 'male',
            'password' =>Hash::make('admin123')
         ]);
    }
}
