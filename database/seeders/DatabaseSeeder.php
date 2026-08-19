<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            DepartmentSeeder::class,
            DonorLogoSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            QuotationAnalysisCriterionSeeder::class,
        ]);
    }
}
