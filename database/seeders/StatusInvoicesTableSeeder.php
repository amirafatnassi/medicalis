<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusInvoice;

class StatusInvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusInvoice::create([
            'id' => 1,
            'lib' => 'Envoyé'
        ]);
        StatusInvoice::create([
            'id' => 2,
            'lib' => 'Reçu'
        ]);
        StatusInvoice::create([
            'id' => 3,
            'lib' => 'Brouillon'
        ]);
        StatusInvoice::create([
            'id' => 4,
            'lib' => 'En retard'
        ]);
        StatusInvoice::create([
            'id' => 5,
            'lib' => 'Payé'
        ]);
        StatusInvoice::create([
            'id' => 6,
            'lib' => 'Contesté'
        ]);
        StatusInvoice::create([
            'id' => 7,
            'lib' => 'Annulé'
        ]);
        StatusInvoice::create([
            'id' => 8,
            'lib' => 'Confirmé'
        ]);
    }
}
