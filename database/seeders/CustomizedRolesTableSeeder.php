<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomizedRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('roles')->delete();
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->insert(array(
            0 =>
            array(
                'id' => 1,
                'description' => 'Master',
                'created_at' => '2023-12-20 09:39:55',
                'updated_at' => '2023-12-20 09:39:55',
            ),
        ));
        Schema::enableForeignKeyConstraints();
    }
}
