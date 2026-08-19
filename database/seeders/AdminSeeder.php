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
            [
                'email' => 'info@ngoforum.org.kh',
            ],
            [
                'name' => 'Administrator',
                'password' => Hash::make('NGOF@Finance2026'),
                'phone' => '078550449',
                'role_id' => 1,          // Admin Role
                'department_id' => 1,    // Administration Department
                'is_active' => true,
            ]
        );
    }
}
