<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomizedPropertyTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('property_types')->delete();
        Schema::disableForeignKeyConstraints();
        DB::table('property_types')->insert(array(
            0 =>
            array(
                'id' => 1,
                'description' => 'Apartamento',
                'created_at' => '2023-12-19 09:36:21',
                'updated_at' => '2023-12-19 09:36:21',
            ),
            1 =>
            array(
                'id' => 2,
                'description' => 'Quinta',
                'created_at' => '2023-12-19 09:36:39',
                'updated_at' => '2023-12-19 09:36:39',
            ),
            2 =>
            array(
                'id' => 3,
                'description' => 'Townhouse',
                'created_at' => '2023-12-19 09:36:46',
                'updated_at' => '2023-12-19 09:36:46',
            ),
            3 =>
            array(
                'id' => 4,
                'description' => 'Terreno',
                'created_at' => '2023-12-19 09:36:54',
                'updated_at' => '2023-12-19 09:36:54',
            ),
            4 =>
            array(
                'id' => 5,
                'description' => 'Parcela',
                'created_at' => '2023-12-19 09:37:01',
                'updated_at' => '2023-12-19 09:37:01',
            ),
            5 =>
            array(
                'id' => 6,
                'description' => 'Galpon',
                'created_at' => '2023-12-19 09:37:05',
                'updated_at' => '2023-12-19 09:37:05',
            ),
            6 =>
            array(
                'id' => 7,
                'description' => 'Local',
                'created_at' => '2023-12-19 09:37:11',
                'updated_at' => '2023-12-19 09:37:11',
            ),
            7 =>
            array(
                'id' => 8,
                'description' => 'Oficina',
                'created_at' => '2023-12-19 09:37:17',
                'updated_at' => '2023-12-19 09:37:17',
            ),
        ));
        Schema::enableForeignKeyConstraints();
    }
}
