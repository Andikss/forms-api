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
     */
    public function run(): void
    {
        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'name'     => 'user' . $i,
                'email'    => 'user' . $i . '@webtech.id',
                'password' => Hash::make('password')
            ]);
        }
    }
}
