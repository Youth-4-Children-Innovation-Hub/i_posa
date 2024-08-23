<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mikoa;
use App\Models\Wilaya;
use Illuminate\Support\Facades\DB;

class districtseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $data=[
            ['name' => 'Ileje', 'region_id' => 24],
            ['name' => 'Mbozi', 'region_id' => 24],
            ['name' => 'Momba', 'region_id' => 24],
            ['name' => 'Igunga', 'region_id' => 25],
['name' => 'Kaliua', 'region_id' => 25],
['name' => 'Nzega', 'region_id' => 25],
['name' => 'Sikonge', 'region_id' => 25],
['name' => 'Tabora Municipal', 'region_id' => 25],
['name' => 'Urambo', 'region_id' => 25],
['name' => 'Uyui', 'region_id' => 25]

            
    ];
    DB::table('wilaya')->insert($data);
    }
  
}
