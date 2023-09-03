<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id' => 1,
            'lib' => 'admin',
        ]);
        Role::create([
            'id' => 2,
            'lib' => 'patient',
        ]);
        Role::create([
            'id' => 3,
            'lib' => 'medecin',
        ]);
        Role::create([
            'id' => 4,
            'lib' => 'coordinateur'
        ]);
        Role::create([
            'id' => 5,
            'lib' => 'representant'
        ]);
         Role::create([
            'id' => 6,
            'lib' => 'coordinateurChef'
        ]);
    }
}
