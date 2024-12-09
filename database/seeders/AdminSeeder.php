<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'me@local.dev'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('19216811'),
                'permission' => 255,
                'email_verified_at' => now()
            ]
        );
    }
}
