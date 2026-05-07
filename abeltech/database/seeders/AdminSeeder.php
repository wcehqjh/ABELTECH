<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@abeltech.ma'],
            [
                'name'     => 'Admin Abeltech',
                'email'    => 'admin@abeltech.ma',
                'password' => Hash::make('Abeltech2024!'),
                'is_admin' => true,
            ]
        );
    }
}