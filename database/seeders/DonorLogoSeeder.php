<?php

namespace Database\Seeders;

use App\Models\DonorLogo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DonorLogoSeeder extends Seeder
{
    public function run(): void
    {
        $donors = [
            ['name' => 'Save the Children', 'logo' => 'save.png'],
            ['name' => 'ActionAid', 'logo' => 'actionaid.png'],
            ['name' => 'Australian Aid', 'logo' => 'australian_aid.jpg'],
            ['name' => 'Caritas Australia', 'logo' => 'caritas_australia.jpg'],
            ['name' => 'CEPA', 'logo' => 'CEPA.jpg'],
            ['name' => 'Danmission', 'logo' => 'da.png'],
            ['name' => 'DCA', 'logo' => 'DCA.jpg'],
            ['name' => 'Global Environmental Institute (GEI)', 'logo' => 'GEI.png'],
            ['name' => 'HEKS EPER', 'logo' => 'HEKS_H_CMYK.jpg'],
            ['name' => 'International Budget Partnership (IBP)', 'logo' => 'IBP.png'],
            ['name' => 'International Land Coalition (ILC)', 'logo' => 'ILC.png'],
            ['name' => 'European Union', 'logo' => 'EU.png'],
            ['name' => 'MRLG', 'logo' => 'mrlg.png'],
            ['name' => 'Oxfam', 'logo' => 'Oxfam.jpg'],
            ['name' => 'Ponlok Chomnes', 'logo' => 'Polok Chamnes.jpg'],
            ['name' => 'Porticus', 'logo' => 'porticus.jpg'],
            ['name' => 'Swiss Agency for Development and Cooperation (SDC)', 'logo' => 'SDC.png'],
            ['name' => 'Sweden', 'logo' => 'Sweden.jpg'],
            ['name' => 'The Asia Foundation', 'logo' => 'The Asia Foundation.jpg'],
        ];

        $sourceFolder = public_path('images/donors');
        $destinationFolder = storage_path('app/public/donor-logos');

        if (!File::exists($destinationFolder)) {
            File::makeDirectory($destinationFolder, 0755, true);
        }

        foreach ($donors as $donor) {

            $source = $sourceFolder . '/' . $donor['logo'];
            $destination = $destinationFolder . '/' . $donor['logo'];

            if (File::exists($source) && !File::exists($destination)) {
                File::copy($source, $destination);
            }

            DonorLogo::updateOrCreate(
                ['name' => $donor['name']],
                [
                    'logo' => 'donor-logos/' . $donor['logo'],
                ]
            );
        }
    }
}
