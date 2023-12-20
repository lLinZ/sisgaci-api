<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomizedPropertyTransactionTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('property_transaction_types')->delete();
        Schema::disableForeignKeyConstraints();
        DB::table('property_transaction_types')->insert(array(
            0 =>
            array(
                'id' => 1,
                'description' => 'Venta',
                'created_at' => '2023-12-19 09:35:54',
                'updated_at' => '2023-12-19 09:35:54',
            ),
            1 =>
            array(
                'id' => 2,
                'description' => 'Alquiler',
                'created_at' => '2023-12-20 12:55:14',
                'updated_at' => '2023-12-20 12:55:14',
            ),
            2 =>
            array(
                'id' => 3,
                'description' => 'Preventa',
                'created_at' => '2023-12-20 12:55:21',
                'updated_at' => '2023-12-20 12:55:21',
            ),
            3 =>
            array(
                'id' => 4,
                'description' => 'Reventa',
                'created_at' => '2023-12-20 12:55:29',
                'updated_at' => '2023-12-20 12:55:29',
            ),
        ));
        Schema::enableForeignKeyConstraints();
    }
}
