<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $locations = [
            1 => [
                'name' => 'ASHOKAPILLAR',
                'address' => 'No.18/1(Old No.125/A),10th Main,Ashoka Pillar Road, Jaynagar 1st Block,Jayanagar,Bengaluru-560011',
                'zip_code' => '560011',
            ],
            2 => [
                'name' => 'INDIRANAGAR NEW',
                'address' => 'No.618, 12th Main, HAL 2nd Stage,Indiranagar, Bengalore 560038.',
                'zip_code' => '560038',
            ],
            3 => [
                'name' => 'Garuda Mall',
                'address' => 'Unit No.SF-210,Garuda Mall,2nd Floor, Magrath Rd, Ashok Nagar, Bengaluru, Karnataka 560025',
                'zip_code' => '560025',
            ],
            4 => [
                'name' => 'WHITEFIELD NEW',
                'address' => 'Prime Square, Ground Floor, No.7, Sathya Sai Layout,Whitefield Main Road, Bangalore-560066',
                'zip_code' => '560066',
            ],
            5 => [
                'name' => 'AIRPORT ROAD - HEBBAL',
                'address' => 'Sattva Galleria, Ground Floor, NO.20/1, Kashi Nagar, Byatarayanapura, Bellary Road, Bengaluru - 560092',
                'zip_code' => '560092',
            ],
            6 => [
                'name' => 'R T NAGAR NEW',
                'address' => 'No.63,10th Main Road, HMT Layout,P&T Colony,RT Nagar, Bangalore - 560032',
                'zip_code' => '560032',
            ],
            7 => [
                'name' => 'YELAHANKA',
                'address' => 'No.452/7,Puttenahalli Village,Yelahanka Subdivision,Doddaballapura Road,Yelahanka,Bangalore - 560064',
                'zip_code' => '560064',
            ],
            8 => [
                'name' => 'JP NAGAR -2',
                'address' => 'No.17/17/18/20/2/1,SaraKkikere Village,JP Nagar,Bangalore-560078',
                'zip_code' => '560078',
            ],
            9 => [
                'name' => 'BANJARA HILLS',
                'address' => 'No.129/38,Shaikpet Village, Road no.12,Banajara Hills, H+A1:B27yderabad - 500034 Telangana',
                'zip_code' => '500034',
            ],
            10 => [
                'name' => 'SARJAPURA',
                'address' => 'No.18/2,Khatha No.629,Ambalipura Village,Sarjapur main Road, Varthur Hobli,Bangalore-560102',
                'zip_code' => '560102',
            ],
            11 => [
                'zip_code' => '44600',
                'name' => 'Bagdool',
                'address' => 'M883+P4R, Bagdol Rd, Lalitpur 44600, Nepal',
            ]
        ];
        
        
        foreach ($locations as $location) {
            $store = new Store([
                'id' => $location['zip_code'],
                'name' => $location['name'],
                'address' => $location['address'],
                'active' => false, // You can set the active status as needed
            ]);

            $store->save();
        }
    }
}
