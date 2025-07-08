<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            DivisionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            TrackSeeder::class,
            LocationSeeder::class,
            UnitsSeeder::class,
            PartnersSeeder::class,
            ProjectsSeeder::class,
            MasterItemsSeeder::class,
            PreorderSeeder::class,
            PreorderItemSeeder::class,
            TravelDocumentSeeder::class,
            ItemsSeeder::class,
            TrackingSystemSeeder::class,
        ]);
    }
}
