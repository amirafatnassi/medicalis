<?php

namespace App\Http\Controllers\coordinateur;

use App\Http\Controllers\Controller;
use App\Models\User;

class medecinController extends Controller
{
    public function index()
    {
        $medecins = User::with('Specialite', 'Ville', 'Country', 'Organisme')
            ->where('role_id', 3)
            ->get();

        return view('coordinateur.medecins.index', compact('medecins'));
    }

    public function show($id)
    {
        $medecin = User::with('Specialite', 'Sexe', 'Ville', 'Country', 'Organisme')
            ->findorFail($id);

        return view('coordinateur.medecins.show', compact('medecin'));
    }
}
