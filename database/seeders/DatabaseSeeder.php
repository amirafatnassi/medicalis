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
        $this->call([
            BloodtypesTableSeeder::class,
            CountriesTableSeeder::class,
            MotifsTableSeeder::class,
            OrganismesTableSeeder::class,
            ProfessionsTableSeeder::class,
            RadiosTableSeeder::class,
            RadiotypesTableSeeder::class,
            SexesTableSeeder::class,
            SpecialiteTableSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            villesTableSeeder::class,
            TypesDemandesTableSeeder::class,
            StatusDemandesTableSeeder::class,
            StatusInvoicesTableSeeder::class,

        ]);
    }
}
