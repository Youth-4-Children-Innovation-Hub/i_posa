<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class rolesseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'role'=>'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            
            ],
            [
                'role'=>'regional cordinator',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role'=>'district cordinator',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role'=>'head of center',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role'=>'user',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            ];
        DB::table('roles')->insert($data);
    }
}
