<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users=User::all();

        $data=[
            [
                'name'=>'Arusha',
                'cordinator_id'=>$users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            
            ],
            [
                'name'=>'Tanga',
                'cordinator_id'=>$users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            
            ],
            [
                'name'=>'Dar es salaam',
                'cordinator_id'=>$users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            ];

            DB::table('regions')->insert($data);
    }
}
