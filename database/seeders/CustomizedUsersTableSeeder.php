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
                'level' => '10',
                'department_id' => NULL,
                'role_id' => 1,
                'status_id' => 1,
                'email_verified_at' => NULL,
                'password' => '$2y$12$SVCYDIa8adTnLbedFJa6uu.3f9JxkWSTSGwD7h02crTzFoBO95LGi',
                'remember_token' => NULL,
                'created_at' => '2023-12-14 11:44:29',
                'updated_at' => '2023-12-29 14:05:21',
            ),
            1 =>
            array(
                'id' => 2,
                'first_name' => 'Kellvin',
                'middle_name' => 'Kellvin',
                'lastname' => 'Africano',
                'second_lastname' => 'Africano',
                'document' => '15418051',
                'address' => 'Valencia, Carabobo',
                'phone' => '04144956845',
                'email' => 'kellvin_africano@consolitex.org',
                'photo' => NULL,
                'color' => '#4caf50',
                'level' => '10',
                'department_id' => NULL,
                'role_id' => 1,
                'status_id' => 1,
                'email_verified_at' => NULL,
                'password' => '$2y$12$EoUbb2yF.ciAzmitqm5NF.PWqFR5RRnHTKryJWCXZKjzHqtG1PHBm',
                'remember_token' => NULL,
                'created_at' => '2023-12-28 11:57:30',
                'updated_at' => '2023-12-28 11:57:30',
            ),
            2 =>
            array(
                'id' => 3,
                'first_name' => 'Dayana',
                'middle_name' => 'Maria',
                'lastname' => 'Lugo',
                'second_lastname' => 'Manzo',
                'document' => '17551862',
                'address' => 'valencia',
                'phone' => '4144029820',
                'email' => 'dayana_lugo@consolitex.org',
                'photo' => NULL,
                'color' => '#4caf50',
                'level' => '1',
                'department_id' => NULL,
                'role_id' => 1,
                'status_id' => 1,
                'email_verified_at' => NULL,
                'password' => '$2y$12$eGZF0oXE3fPPTI4PEKvvNOlI7v8ZmrHRCkHWIVvhzljsUCFLMiI1e',
                'remember_token' => NULL,
                'created_at' => '2024-01-03 10:33:13',
                'updated_at' => '2024-01-03 10:33:13',
            ),
            3 =>
            array(
                'id' => 4,
                'first_name' => 'Lorena',
                'middle_name' => 'Alejandra',
                'lastname' => 'Galvis',
                'second_lastname' => 'Araujo',
                'document' => '20161130',
                'address' => 'valencia',
                'phone' => '4144406277',
                'email' => 'lorena_galvis@consolitex.org',
                'photo' => NULL,
                'color' => '#4caf50',
                'level' => '1',
                'department_id' => NULL,
                'role_id' => 1,
                'status_id' => 1,
                'email_verified_at' => NULL,
                'password' => '$2y$12$GeQIWTA/BLjxog0rYxFdL.Mqif0fpIKJ62l7a0o8RkHmWehKYF6Gu',
                'remember_token' => NULL,
                'created_at' => '2024-01-03 10:34:13',
                'updated_at' => '2024-01-03 10:34:13',
            ),
        ));
        Schema::enaableForeignKeyConstraints();
    }
}
