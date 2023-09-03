<?php

namespace Database\Seeders;
use App\Models\TypeDemande;
use Illuminate\Database\Seeder;

class TypesDemandesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeDemande::create([
            'id' => 1,
            'lib' => 'Demande de devis'
        ]);
        TypeDemande::create([
            'id' => 2,
            'lib' => 'Demande informations'
        ]);
        TypeDemande::create([
            'id' => 3,
            'lib' => 'test'
        ]);
    }
}
