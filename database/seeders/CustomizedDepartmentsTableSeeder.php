<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedDepartmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('departments')->delete();
        
        \DB::table('departments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Sistemas',
                'created_at' => '2023-12-20 15:39:23',
                'updated_at' => '2023-12-20 15:39:23',
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Gerencia',
                'created_at' => '2023-12-20 15:39:28',
                'updated_at' => '2023-12-20 15:39:28',
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'Ventas',
                'created_at' => '2023-12-20 15:39:34',
                'updated_at' => '2023-12-20 15:39:34',
            ),
            3 => 
            array (
                'id' => 4,
                'description' => 'RRHH',
                'created_at' => '2023-12-20 15:39:39',
                'updated_at' => '2023-12-20 15:39:39',
            ),
            4 => 
            array (
                'id' => 5,
                'description' => 'Contabilidad',
                'created_at' => '2023-12-20 15:39:46',
                'updated_at' => '2023-12-20 15:39:46',
            ),
            5 => 
            array (
                'id' => 6,
                'description' => 'Administracion',
                'created_at' => '2023-12-20 15:39:53',
                'updated_at' => '2023-12-20 15:39:53',
            ),
            6 => 
            array (
                'id' => 7,
                'description' => 'Transcripcion',
                'created_at' => '2023-12-20 15:39:59',
                'updated_at' => '2023-12-20 15:39:59',
            ),
            7 => 
            array (
                'id' => 8,
                'description' => 'Recepcion',
                'created_at' => '2023-12-20 15:40:08',
                'updated_at' => '2023-12-20 15:40:08',
            ),
            8 => 
            array (
                'id' => 9,
                'description' => 'SAC',
                'created_at' => '2023-12-20 15:40:12',
                'updated_at' => '2023-12-20 15:40:12',
            ),
            9 => 
            array (
                'id' => 10,
                'description' => 'Medios Digitales',
                'created_at' => '2023-12-20 15:40:24',
                'updated_at' => '2023-12-20 15:40:24',
            ),
            10 => 
            array (
                'id' => 11,
                'description' => 'Archivo',
                'created_at' => '2023-12-20 15:40:28',
                'updated_at' => '2023-12-20 15:40:28',
            ),
        ));
        
        
    }
}