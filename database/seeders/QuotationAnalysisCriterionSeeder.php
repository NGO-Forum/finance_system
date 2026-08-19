<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuotationAnalysisCriterionSeeder extends Seeder
{
    public function run(): void
    {
        $criteria = [

            ['name' => 'Price', 'sort_order' => 1],

            ['name' => 'Quality', 'sort_order' => 2],

            ['name' => 'Reliability / Reputation', 'sort_order' => 3],

            ['name' => 'After-sale Service', 'sort_order' => 4],

            ['name' => 'Validity Date', 'sort_order' => 5],

            ['name' => 'Payment Term', 'sort_order' => 6],

            ['name' => 'Legality', 'sort_order' => 7],

            ['name' => 'Other Factors', 'sort_order' => 8],

        ];

        foreach ($criteria as $item) {

            \App\Models\QuotationAnalysisCriterion::create($item);
        }
    }
}
