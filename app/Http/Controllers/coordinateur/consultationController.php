<?php

namespace App\Http\Controllers\coordinateur;

use App\Http\Controllers\Controller;
use App\Models\Dossier;
use App\Models\Consultation;

class consultationController extends Controller
{
    public function index($id)
    {
        $dossier = Dossier::findorFail($id);
        $liste_consultations = Consultation::where('dossier_id', $id)->get();

        return view('coordinateur.dossiers.consultations.index', compact('dossier', 'liste_consultations'));
    }

    public function show($id)
    {
        $consultation = Consultation::findorFail($id);
        $dossier = Dossier::findorFail($consultation->dossier_id);

        return view('coordinateur.dossiers.consultations.show', compact('consultation', 'dossier'));
    }

    public function showExamenfiles($id)
    {
        $consultation = Consultation::findorfail($id);
        $dossier = Dossier::findorfail($consultation->dossier_id);

        return view('coordinateur.dossiers.consultations.files', compact('dossier'));
    }
}
