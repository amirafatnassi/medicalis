<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'nom' => 'admin',
            'prenom'=>'admin',
            'tel'=>99059374,
            'email'=>'admin@dmc.com',
            'password'=>Hash::make('admin'),
            'role_id'=>1,
            'country_id'=>'TN',
            'datenaissance' => Carbon::createFromFormat('d/m/Y', '23/10/1988')->format('Y-m-d'),
            'user_approuved_by' => 1,
            'user_approuved_at' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
        ]);
        User::create([
            'id' => 2,
            'nom' => 'fatnassi',
            'prenom'=>'amira',
            'tel'=>99059374,
            'email'=>'amirafatnassi88@gmail.com',
            'password'=>Hash::make('amira'),
            'role_id'=>2,
            'country_id'=>'TN',
            'datenaissance' => Carbon::createFromFormat('d/m/Y', '23/10/1988')->format('Y-m-d'),
            'user_approuved_by' => 1,
            'user_approuved_at' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
        ]);
    }
}
