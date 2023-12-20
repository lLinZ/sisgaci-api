<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomizedStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('statuses')->delete();
        Schema::disableForeignKeyConstraints();
        DB::table('statuses')->insert(array(
            0 =>
            array(
                'id' => 1,
                'description' => 'Activo',
                'created_at' => '2023-12-19 09:38:52',
                'updated_at' => '2023-12-19 09:38:52',
            ),
        ));
        Schema::enableForeignKeyConstraints();
    }
}
