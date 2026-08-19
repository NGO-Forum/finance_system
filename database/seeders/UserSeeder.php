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
                'name' => 'CHAN Vicheth',
                'email' => 'vicheth@ngoforum.org.kh',
                'role_id' => 3,
                'department_id' => 4,
            ],

            [
                'name' => 'CHEN Sochoeun',
                'email' => 'sochoeun@ngoforum.org.kh',
                'role_id' => 5,
                'department_id' => 3,
            ],

            [
                'name' => 'CHHAY Bunna',
                'email' => 'bunna@ngoforum.org.kh',
                'role_id' => 5,
                'department_id' => 4,
            ],

            [
                'name' => 'CHHAY Tola',
                'email' => 'tola@ngoforum.org.kh',
                'role_id' => 5,
                'department_id' => 2,
            ],

            [
                'name' => 'KEO Vicheka',
                'email' => 'vicheka@ngoforum.org.kh',
                'role_id' => 7,
                'department_id' => 3,
            ],

            [
                'name' => 'LIN Leaksopor',
                'email' => 'leaksopor@ngoforum.org.kh',
                'role_id' => 2,
                'department_id' => 5,
            ],

            [
                'name' => 'MAR Sophal',
                'email' => 'sophal@ngoforum.org.kh',
                'role_id' => 3,
                'department_id' => 2,
            ],

            [
                'name' => 'MEAS Ronn',
                'email' => 'ronn@ngoforum.org.kh',
                'role_id' => 5,
                'department_id' => 5,
            ],

            [
                'name' => 'SORK Mengseu',
                'email' => 'mengseu@ngoforum.org.kh',
                'role_id' => 7,
                'department_id' => 4,
            ],

            [
                'name' => 'OUM Somaly',
                'email' => 'somaly@ngoforum.org.kh',
                'role_id' => 3,
                'department_id' => 3,
            ],

            [
                'name' => 'RIDD Chansoksreynich',
                'email' => 'sreynich@ngoforum.org.kh',
                'role_id' => 5,
                'department_id' => 5,
            ],

            [
                'name' => 'DORN Sochea',
                'email' => 'sochea@ngoforum.org.kh',
                'role_id' => 6,
                'department_id' => 5,
            ],

            [
                'name' => 'SOEUNG Saroeun',
                'email' => 'saroeun@ngoforum.org.kh',
                'role_id' => 4,
                'department_id' => 1,
            ],

            [
                'name' => 'SOL Lyhorng',
                'email' => 'sollyhorng@ngoforum.org.kh',
                'role_id' => 5,
                'department_id' => 4,
            ],

            [
                'name' => 'SOM Chettana',
                'email' => 'chettana@ngoforum.org.kh',
                'role_id' => 2,
                'department_id' => 5,
            ],

            [
                'name' => 'HEOURN Sreytouch',
                'email' => 'sreytouch@ngoforum.org.kh',
                'role_id' => 7,
                'department_id' => 3,
            ],

            [
                'name' => 'Y Reaksmey',
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
