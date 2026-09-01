<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [

            // Users
            [
                'name' => 'Mr. CHAN Vicheth',
                'email' => 'vicheth@ngoforum.org.kh',
                'role_id' => 3,
                'department_id' => 4,
            ],

            [
                'name' => 'Mr. CHEN Sochoeun',
                'email' => 'sochoeun@ngoforum.org.kh',
                'role_id' => 5,
                'department_id' => 3,
            ],

            [
                'name' => 'Mr. CHHAY Bunna',
                'email' => 'bunna@ngoforum.org.kh',
                'role_id' => 5,
                'department_id' => 4,
            ],

            [
                'name' => 'Ms. CHHAY Tola',
                'email' => 'tola@ngoforum.org.kh',
                'role_id' => 5,
                'department_id' => 2,
            ],

            [
                'name' => 'Ms. KEO Vicheka',
                'email' => 'vicheka@ngoforum.org.kh',
                'role_id' => 7,
                'department_id' => 3,
            ],

            [
                'name' => 'Mrs. LIN Leaksopor',
                'email' => 'leaksopor@ngoforum.org.kh',
                'role_id' => 2,
                'department_id' => 5,
            ],

            [
                'name' => 'Mr. MAR Sophal',
                'email' => 'sophal@ngoforum.org.kh',
                'role_id' => 3,
                'department_id' => 2,
            ],

            [
                'name' => 'Mr. MEAS Ronn',
                'email' => 'ronn@ngoforum.org.kh',
                'role_id' => 5,
                'department_id' => 5,
            ],

            [
                'name' => 'Mr. SORK Mengseu',
                'email' => 'mengseu@ngoforum.org.kh',
                'role_id' => 7,
                'department_id' => 4,
            ],

            [
                'name' => 'Ms. RIDD Chansoksreynich',
                'email' => 'sreynich@ngoforum.org.kh',
                'role_id' => 5,
                'department_id' => 5,
            ],

            [
                'name' => 'Ms. DORN Sochea',
                'email' => 'sochea@ngoforum.org.kh',
                'role_id' => 6,
                'department_id' => 5,
            ],

            [
                'name' => 'Mr. SOEUNG Saroeun',
                'email' => 'saroeun@ngoforum.org.kh',
                'role_id' => 4,
                'department_id' => 1,
            ],

            [
                'name' => 'Ms. SOL Lyhorng',
                'email' => 'sollyhorng@ngoforum.org.kh',
                'role_id' => 5,
                'department_id' => 4,
            ],

            [
                'name' => 'Mr. SOM Chettana',
                'email' => 'chettana@ngoforum.org.kh',
                'role_id' => 3,
                'department_id' => 5,
            ],

            [
                'name' => 'Ms. HEOURN Sreytouch',
                'email' => 'sreytouch@ngoforum.org.kh',
                'role_id' => 7,
                'department_id' => 3,
            ],

            [
                'name' => 'Ms. Y Reaksmey',
                'email' => 'reaksmey@ngoforum.org.kh',
                'role_id' => 6,
                'department_id' => 3,
            ],
        ];

        foreach ($users as $user) {

            User::updateOrCreate(
                [
                    'email' => $user['email'],
                ],
                [
                    'name' => $user['name'],
                    'password' => Hash::make('Finance2026'),
                    'phone' => '012345678',
                    'role_id' => $user['role_id'],
                    'department_id' => $user['department_id'] ?? 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
