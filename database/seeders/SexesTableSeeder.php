<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sexe;

class SexesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sexe::create([
            'id'=>1,
            'lib'=>'Masculin'
        ]);
        Sexe::create([
            'id'=>2,
            'lib'=>'Féminin'
        ]);
    }
}
