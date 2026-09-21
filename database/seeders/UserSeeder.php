<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'super@admin.email',],
            [
                'name' => 'Super Admin',
                'email' => 'super@admin.email',
                'password' => Hash::make('superadminpassword'),
                'email_verified_at' => now(),
            ]
        );
    }
}
