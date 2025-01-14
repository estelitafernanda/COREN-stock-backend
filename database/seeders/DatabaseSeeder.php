<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SectorSeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
            RequestSeeder::class,
            ResponseSeeder::class,
            MovementSeeder::class,
        ]);
    }
}
