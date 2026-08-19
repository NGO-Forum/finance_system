<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [

            [
                'name' => 'Administration',
                'description' => 'Administration Department'
            ],

            [
                'name' => 'PALI Program',
                'description' => 'PALI aims to engage and influence global, regional, and national laws and policies affecting the poor, indigenous, marginalized, and vulnerable groups and people.'
            ],

            [
                'name' => 'SACHAS Program',
                'description' => 'SACHAS aims at supporting NGOF’s members, partners, and communities to operationalize key laws and policies mentioned above into practices, and to support their local-led initiatives to transform their communities toward harmonious, prosperous, resilient and sustainable ones.'
            ],

            [
                'name' => 'RITI Program',
                'description' => 'RITI aims to transform the NGOF, NGOF’s members and their partners/communities (incl. ACs, CPA, CFi, and CF) so that they will become resilient, innovative, and transformative institutions that can sustainably support Cambodia’s development.'
            ],

            [
                'name' => 'MACOR Program',
                'description' => 'MACOR aims at supporting the NGOF to become a transparent, accountable, responsible and sustainable membership-based organization.'
            ],

        ];

        foreach ($departments as $department) {

            Department::updateOrCreate(
                ['name' => $department['name']],
                [
                    'description' => $department['description']
                ]
            );
        }
    }
}
