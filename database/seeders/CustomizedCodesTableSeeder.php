<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('codes')->delete();
        
        \DB::table('codes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Quinta',
                'letter' => 'Q',
                'number' => 0,
                'created_at' => '2023-12-20 14:01:02',
                'updated_at' => '2023-12-20 14:01:02',
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Apartamento',
                'letter' => 'A',
                'number' => 0,
                'created_at' => '2023-12-20 14:01:51',
                'updated_at' => '2023-12-20 14:01:51',
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'Local',
                'letter' => 'L',
                'number' => 0,
                'created_at' => '2023-12-20 14:02:02',
                'updated_at' => '2023-12-20 14:02:02',
            ),
            3 => 
            array (
                'id' => 4,
                'description' => 'Terreno',
                'letter' => 'T',
                'number' => 0,
                'created_at' => '2023-12-20 14:06:08',
                'updated_at' => '2023-12-20 14:06:08',
            ),
            4 => 
            array (
                'id' => 5,
                'description' => 'Galpon',
                'letter' => 'G',
                'number' => 0,
                'created_at' => '2023-12-20 14:06:21',
                'updated_at' => '2023-12-20 14:06:21',
            ),
            5 => 
            array (
                'id' => 6,
                'description' => 'Oficina',
                'letter' => 'O',
                'number' => 0,
                'created_at' => '2023-12-20 14:06:29',
                'updated_at' => '2023-12-20 14:06:29',
            ),
            6 => 
            array (
                'id' => 7,
                'description' => 'Parcela',
                'letter' => 'P',
                'number' => 0,
                'created_at' => '2023-12-20 14:06:38',
                'updated_at' => '2023-12-20 14:06:38',
            ),
        ));
        
        
    }
}