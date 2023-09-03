<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusDemande;

class StatusDemandesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusDemande::create([
            'id' => 1,
            'lib' => 'Lancé'
        ]);
        StatusDemande::create([
            'id' => 2,
            'lib' => 'En cours de traitement'
        ]);
        StatusDemande::create([
            'id' => 3,
            'lib' => 'En attente de compléments d\'informations'
        ]);
        StatusDemande::create([
            'id' => 4,
            'lib' => 'Cloturé'
        ]);
        StatusDemande::create([
            'id' => 5,
            'lib' => 'Cloturé par le représentanr'
        ]);
        StatusDemande::create([
            'id' => 6,
            'lib' => 'Pris en charge'
        ]);
        StatusDemande::create([
            'id' => 7,
            'lib' => 'Lu et en attente de réponse'
        ]);
        StatusDemande::create([
            'id' => 8,
            'lib' => 'Lu et répondu'
        ]);
        StatusDemande::create([
            'id' => 9,
            'lib' => 'Informations complémentaires demandés reçues'
        ]);
    }
}
