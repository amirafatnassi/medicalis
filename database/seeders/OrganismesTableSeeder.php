<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organisme;

class OrganismesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organisme::create([
            'id'=>1,
            'lib'=>'Hopital publique'
        ]);

        Organisme::create([
            'id'=>2,
            'lib'=>'Clinique'
        ]);

        Organisme::create([
            'id'=>3,
            'lib'=>'Cabinet privé'
        ]);

        Organisme::create([
            'id'=>4,
            'lib'=>'Centre de radiologie'
        ]);

        Organisme::create([
            'id'=>5,
            'lib'=>'Autres'
        ]);
    }
}
