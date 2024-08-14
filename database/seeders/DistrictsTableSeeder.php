<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wilaya')->insert([
            // Simiyu Region
            ['name' => 'Bariadi', 'region_id' => 22],
            ['name' => 'Busega', 'region_id' => 22],
            ['name' => 'Itilima', 'region_id' => 22],
            ['name' => 'Maswa', 'region_id' => 22],
            ['name' => 'Meatu', 'region_id' => 22],
            ['name' => 'Simiyu', 'region_id' => 22],

            // Singida Region
            ['name' => 'Manyoni', 'region_id' => 23],
            ['name' => 'Mkalama', 'region_id' => 23],
            ['name' => 'Singida Rural', 'region_id' => 23],
            ['name' => 'Singida Urban', 'region_id' => 23],

            // Songwe Region
            ['name' => 'Momba', 'region_id' => 24],
            ['name' => 'Mbozi', 'region_id' => 24],
            ['name' => 'Songwe', 'region_id' => 24],
            ['name' => 'Ileje', 'region_id' => 24],
            ['name' => 'Tunduma', 'region_id' => 24],

            // Tabora Region
            ['name' => 'Tabora Municipal', 'region_id' => 25],
            ['name' => 'Tabora Rural', 'region_id' => 25],
            ['name' => 'Nzega', 'region_id' => 25],
            ['name' => 'Igunga', 'region_id' => 25],
            ['name' => 'Urambo', 'region_id' => 25],
            ['name' => 'Kaliua', 'region_id' => 25],
            // Arusha (region_id = 1)
            // ['name' => 'Arusha City', 'region_id' => 1],
            // ['name' => 'Arusha Rural', 'region_id' => 1],
            // ['name' => 'Karatu', 'region_id' => 1],
            // ['name' => 'Longido', 'region_id' => 1],
            // ['name' => 'Meru', 'region_id' => 1],
            // ['name' => 'Monduli', 'region_id' => 1],
            // ['name' => 'Ngorongoro', 'region_id' => 1],

            // // Dar es Salaam (region_id = 2)
            // ['name' => 'Ilala', 'region_id' => 2],
            // ['name' => 'Kinondoni', 'region_id' => 2],
            // ['name' => 'Temeke', 'region_id' => 2],
            // ['name' => 'Kigamboni', 'region_id' => 2],
            // ['name' => 'Ubungo', 'region_id' => 2],

            // // Dodoma (region_id = 3)
            // ['name' => 'Bahi', 'region_id' => 3],
            // ['name' => 'Chamwino', 'region_id' => 3],
            // ['name' => 'Chemba', 'region_id' => 3],
            // ['name' => 'Dodoma City', 'region_id' => 3],
            // ['name' => 'Kondoa', 'region_id' => 3],
            // ['name' => 'Mpwapwa', 'region_id' => 3],

            // // Geita (region_id = 4)
            // ['name' => 'Bukombe', 'region_id' => 4],
            // ['name' => 'Chato', 'region_id' => 4],
            // ['name' => 'Geita', 'region_id' => 4],
            // ['name' => 'Mbogwe', 'region_id' => 4],
            // ['name' => 'Nyang\'hwale', 'region_id' => 4],

            // // Iringa (region_id = 5)
            // ['name' => 'Iringa Rural', 'region_id' => 5],
            // ['name' => 'Iringa Urban', 'region_id' => 5],
            // ['name' => 'Kilolo', 'region_id' => 5],
            // ['name' => 'Mafinga Town', 'region_id' => 5],
            // ['name' => 'Mufindi', 'region_id' => 5],

            // // Kagera (region_id = 6)
            // ['name' => 'Biharamulo', 'region_id' => 6],
            // ['name' => 'Bukoba Rural', 'region_id' => 6],
            // ['name' => 'Bukoba Urban', 'region_id' => 6],
            // ['name' => 'Karagwe', 'region_id' => 6],
            // ['name' => 'Kyerwa', 'region_id' => 6],
            // ['name' => 'Missenyi', 'region_id' => 6],
            // ['name' => 'Muleba', 'region_id' => 6],
            // ['name' => 'Ngara', 'region_id' => 6],

            // // Katavi (region_id = 7)
            // ['name' => 'Mpanda Town', 'region_id' => 7],
            // ['name' => 'Mpanda Rural', 'region_id' => 7],
            // ['name' => 'Mlele', 'region_id' => 7],

            // // Kigoma (region_id = 8)
            // ['name' => 'Buhigwe', 'region_id' => 8],
            // ['name' => 'Kakonko', 'region_id' => 8],
            // ['name' => 'Kasulu Rural', 'region_id' => 8],
            // ['name' => 'Kasulu Urban', 'region_id' => 8],
            // ['name' => 'Kibondo', 'region_id' => 8],
            // ['name' => 'Kigoma Rural', 'region_id' => 8],
            // ['name' => 'Kigoma Urban', 'region_id' => 8],
            // ['name' => 'Uvinza', 'region_id' => 8],

            // // Kilimanjaro (region_id = 9)
            // ['name' => 'Hai', 'region_id' => 9],
            // ['name' => 'Moshi Rural', 'region_id' => 9],
            // ['name' => 'Moshi Urban', 'region_id' => 9],
            // ['name' => 'Mwanga', 'region_id' => 9],
            // ['name' => 'Rombo', 'region_id' => 9],
            // ['name' => 'Same', 'region_id' => 9],
            // ['name' => 'Siha', 'region_id' => 9],

            // // Lindi (region_id = 10)
            // ['name' => 'Kilwa', 'region_id' => 10],
            // ['name' => 'Lindi Rural', 'region_id' => 10],
            // ['name' => 'Lindi Urban', 'region_id' => 10],
            // ['name' => 'Liwale', 'region_id' => 10],
            // ['name' => 'Nachingwea', 'region_id' => 10],
            // ['name' => 'Ruangwa', 'region_id' => 10],

            // // Manyara (region_id = 11)
            // ['name' => 'Babati Rural', 'region_id' => 11],
            // ['name' => 'Babati Urban', 'region_id' => 11],
            // ['name' => 'Hanang', 'region_id' => 11],
            // ['name' => 'Kiteto', 'region_id' => 11],
            // ['name' => 'Mbulu', 'region_id' => 11],
            // ['name' => 'Simanjiro', 'region_id' => 11],

            // // Mara (region_id = 12)
            // ['name' => 'Bunda', 'region_id' => 12],
            // ['name' => 'Butiama', 'region_id' => 12],
            // ['name' => 'Musoma Rural', 'region_id' => 12],
            // ['name' => 'Musoma Urban', 'region_id' => 12],
            // ['name' => 'Rorya', 'region_id' => 12],
            // ['name' => 'Serengeti', 'region_id' => 12],
            // ['name' => 'Tarime', 'region_id' => 12],

            // // Mbeya (region_id = 13)
            // ['name' => 'Busokelo', 'region_id' => 13],
            // ['name' => 'Chunya', 'region_id' => 13],
            // ['name' => 'Kyela', 'region_id' => 13],
            // ['name' => 'Mbeya Rural', 'region_id' => 13],
            // ['name' => 'Mbeya Urban', 'region_id' => 13],
            // ['name' => 'Mbarali', 'region_id' => 13],
            // ['name' => 'Rungwe', 'region_id' => 13],

            // // Morogoro (region_id = 14)
            // ['name' => 'Gairo', 'region_id' => 14],
            // ['name' => 'Kilombero', 'region_id' => 14],
            // ['name' => 'Kilosa', 'region_id' => 14],
            // ['name' => 'Morogoro Rural', 'region_id' => 14],
            // ['name' => 'Morogoro Urban', 'region_id' => 14],
            // ['name' => 'Mvomero', 'region_id' => 14],
            // ['name' => 'Ulanga', 'region_id' => 14],
            // ['name' => 'Malinyi', 'region_id' => 14],

            // // Mtwara (region_id = 15)
            // ['name' => 'Masasi', 'region_id' => 15],
            // ['name' => 'Masasi Town', 'region_id' => 15],
            // ['name' => 'Mtwara Rural', 'region_id' => 15],
            // ['name' => 'Mtwara Urban', 'region_id' => 15],
            // ['name' => 'Nanyamba', 'region_id' => 15],
            // ['name' => 'Nanyumbu', 'region_id' => 15],
            // ['name' => 'Tandahimba', 'region_id' => 15],

            // // Mwanza (region_id = 16)
            // ['name' => 'Ilemela', 'region_id' => 16],
            // ['name' => 'Kwimba', 'region_id' => 16],
            // ['name' => 'Magu', 'region_id' => 16],
            // ['name' => 'Misungwi', 'region_id' => 16],
            // ['name' => 'Nyamagana', 'region_id' => 16],
            // ['name' => 'Sengerema', 'region_id' => 16],
            // ['name' => 'Ukerewe', 'region_id' => 16],

            // // Njombe (region_id = 17)
            // ['name' => 'Ludewa', 'region_id' => 17],
            // ['name' => 'Makambako', 'region_id' => 17],
            // ['name' => 'Makete', 'region_id' => 17],
            // ['name' => 'Njombe Rural', 'region_id' => 17],
            // ['name' => 'Njombe Urban', 'region_id' => 17],
            // ['name' => 'Wanging\'ombe', 'region_id' => 17],

            // // Pwani (region_id = 18)
            // ['name' => 'Bagamoyo', 'region_id' => 18],
            // ['name' => 'Kibaha Rural', 'region_id' => 18],
            // ['name' => 'Kibaha Urban', 'region_id' => 18],
            // ['name' => 'Kisarawe', 'region_id' => 18],
            // ['name' => 'Mafia', 'region_id' => 18],
            // ['name' => 'Mkuranga', 'region_id' => 18],
            // ['name' => 'Rufiji', 'region_id' => 18],
            // ['name' => 'Chalinze', 'region_id' => 18],

            // // Rukwa (region_id = 19)
            // ['name' => 'Kalambo', 'region_id' => 19],
            // ['name' => 'Nkasi', 'region_id' => 19],
            // ['name' => 'Sumbawanga Rural', 'region_id' => 19],
            // ['name' => 'Sumbawanga Urban', 'region_id' => 19],

            // // Ruvuma (region_id = 20)
            // ['name' => 'Mbinga', 'region_id' => 20],
            // ['name' => 'Namtumbo', 'region_id' => 20],
            // ['name' => 'Nyasa', 'region_id' => 20],
            // ['name' => 'Songea Rural', 'region_id' => 20],
            // ['name' => 'Songea Urban', 'region_id' => 20],
            // ['name' => 'Tunduru', 'region_id' => 20],

            // // Shinyanga (region_id = 21)
            // ['name' => 'Kahama Rural', 'region_id' => 21],
            // ['name' => 'Kahama Urban', 'region_id' => 21],
            // ['name' => 'Kishapu', 'region_id' => 21],
            // ['name' => 'Shinyanga Rural', 'region_id' => 21],
            // ['name' => 'Shinyanga Urban', 'region_id' => 21],
        ]);
    }
}
