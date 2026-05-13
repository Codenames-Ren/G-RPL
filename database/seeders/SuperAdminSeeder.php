<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Gilbert',
            'email' => 'gilbert@grpl.com',
            'password' => Hash::make('123456'),
            'role' => 'superadmin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }
}