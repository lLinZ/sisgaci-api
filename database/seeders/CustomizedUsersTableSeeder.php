<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomizedUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('users')->delete();
        Schema::disableForeignKeyConstraints();
        DB::table('users')->insert(array(
            0 =>
            array(
                'id' => 1,
                'first_name' => 'Jose',
                'middle_name' => 'Miguel',
                'lastname' => 'Linares',
                'second_lastname' => 'Gonzalez',
                'document' => '24548539',
                'address' => 'Valencia, Carabobo',
                'phone' => '04244137923',
                'email' => 'linz@gmail.com',
                'photo' => NULL,
                'color' => '#4caf50',
                'level' => NULL,
                'department_id' => NULL,
                'role_id' => 1,
                'status_id' => 1,
                'email_verified_at' => NULL,
                'password' => '$2y$12$SVCYDIa8adTnLbedFJa6uu.3f9JxkWSTSGwD7h02crTzFoBO95LGi',
                'remember_token' => NULL,
                'created_at' => '2023-12-14 11:44:29',
                'updated_at' => '2023-12-14 11:44:29',
            ),
        ));
        Schema::enableForeignKeyConstraints();
    }
}
