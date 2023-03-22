<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\Region;






class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles=Role::all();
        $regions=Region::all();

        $data=[
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'role_id'=> $roles->random()->id,
              //  'region_id'=> $regions->random()->id,
                'password' => bcrypt('john123')
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'janedoe@example.com',
                'role_id'=> $roles->random()->id,
               // 'region_id'=> $regions->random()->id,
                
                'password' => bcrypt('jane123')
            ],
            [
                'name' => 'Michael Doe',
                'email' => 'michaeldoe@example.com',
                'role_id'=> $roles->random()->id,
              //  'region_id'=> $regions->random()->id,
                'password' => bcrypt('michael123')
            ]
        ];
        DB::table('users')->insert($data);
    }
}