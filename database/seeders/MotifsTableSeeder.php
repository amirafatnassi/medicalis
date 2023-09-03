<?php

namespace Database\Seeders;
use App\Models\Motif;

use Illuminate\Database\Seeder;

class MotifsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Motif::create([
            'id'=>1,
            'lib'=>'test'
        ]);
    }
}
