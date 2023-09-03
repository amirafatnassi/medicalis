<?php

namespace Database\Seeders;

use App\Models\Ville;
use Illuminate\Database\Seeder;

class villesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ville::create([
            'id_ville' => 1,
            'name' => 'Tunis',
            'code' => 'TN'
        ]);
        Ville::create([
            'id_ville' => 2,
            'name' => 'ben arous',
            'code' => 'TN'
        ]);
        Ville::create([
            'id_ville' => 3,
            'name' => 'Bizerte',
            'code' => 'TN'
        ]);
        Ville::create([
            'id_ville' => 4,
            'name' => 'Sousse',
            'code' => 'TN'
        ]);
        Ville::create([
            'id_ville' => 5,
            'name' => 'Paris',
            'code' => 'FR'
        ]);
        Ville::create([
            'id_ville' => 6,
            'name' => 'Nice',
            'code' => 'FR'
        ]);
        Ville::create([
            'id_ville' => 7,
            'name' => 'Bruxelles',
            'code' => 'BE'
        ]);
        Ville::create([
            'id_ville' => 8,
            'name' => 'Bruges',
            'code' => 'Be'
        ]);
        Ville::create([
            'id_ville' => 9,
            'name' => 'Alger',
            'code' => 'DZ'
        ]);
        Ville::create([
            'id_ville' => 10,
            'name' => 'Constantine',
            'code' => 'DZ'
        ]);
    }
}
