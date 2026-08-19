<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [

            [
                'name' => 'Admin',
                'description' => 'System Administrator'
            ],

            [
                'name' => 'Finance',
                'description' => 'Finance Department'
            ],

            [
                'name' => 'Manager',
                'description' => 'Department Manager'
            ],

            [
                'name' => 'ED',
                'description' => 'Executive Director'
            ],

            [
                'name' => 'Staff',
                'description' => 'Regular Staff'
            ],

            [
                'name' => 'Intern',
                'description' => 'Internship'
            ],

            [
                'name' => 'Consultancy',
                'description' => 'Consultant / Consultancy'
            ],

        ];

        foreach ($roles as $role) {

            Role::updateOrCreate(
                ['name' => $role['name']],
                ['description' => $role['description']]
            );
        }
    }
}
