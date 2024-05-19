<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class regionseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            
                ['name' => 'Arusha'],
                ['name' => 'Dar es Salaam'],
                ['name' => 'Dodoma'],
                ['name' => 'Geita'],
                ['name' => 'Iringa'],
                ['name' => 'Kagera'],
                ['name' => 'Katavi'],
                ['name' => 'Kigoma'],
                ['name' => 'Kilimanjaro'],
                ['name' => 'Lindi'],
                ['name' => 'Manyara'],
                ['name' => 'Mara'],
                ['name' => 'Mbeya'],
                ['name' => 'Morogoro'],
                ['name' => 'Mtwara'],
                ['name' => 'Mwanza'],
                ['name' => 'Njombe'],
                ['name' => 'Pwani'],
                ['name' => 'Rukwa'],
                ['name' => 'Ruvuma'],
                ['name' => 'Shinyanga'],
                ['name' => 'Simiyu'],
                ['name' => 'Singida'],
                ['name' => 'Songwe'],
                ['name' => 'Tabora'],
                ['name' => 'Tanga']
        ];
        DB::table('mikoa')->insert($data);
    }
}
