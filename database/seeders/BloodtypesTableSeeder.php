<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bloodtype;

class BloodtypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bloodtype::create([
            'id'=>1,
            'lib'=>'O+'
        ]);
        Bloodtype::create([
            'id'=>2,
            'lib'=>'O-'
        ]);
        Bloodtype::create([
            'id'=>3,
            'lib'=>'A+'
        ]);
        Bloodtype::create([
            'id'=>4,
            'lib'=>'A-'
        ]);
        Bloodtype::create([
            'id'=>5,
            'lib'=>'B+'
        ]);
        Bloodtype::create([
            'id'=>6,
            'lib'=>'B-'
        ]);
        Bloodtype::create([
            'id'=>7,
            'lib'=>'AB+'
        ]);
        Bloodtype::create([
            'id'=>8,
            'lib'=>'AB-'
        ]);
    }
}
