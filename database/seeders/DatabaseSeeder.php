<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(CustomizedPropertyTypesTableSeeder::class);
        $this->call(CustomizedPropertyTransactionTypesTableSeeder::class);
        $this->call(CustomizedUsersTableSeeder::class);
        $this->call(CustomizedStatusesTableSeeder::class);
        $this->call(CustomizedRolesTableSeeder::class);
        $this->call(CustomizedCodesTableSeeder::class);
        $this->call(CustomizedDepartmentsTableSeeder::class);
        $this->call(CustomizedNewCallsTableSeeder::class);
        $this->call(CustomizedNewFormattedClientsTableSeeder::class);
        $this->call(CustomizedNewFormattedClientAditionalDetailsTableSeeder::class);
    }
}
