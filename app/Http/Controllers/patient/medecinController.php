<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Dossier;
use App\Models\DossierUser;
use App\Models\DossierUserSpecialite;
use App\Models\DossierAccessHistory;
use App\Models\Specialite;
use App\Models\User;
use App\Models\Ville;
use Auth;

class medecinController extends Controller
{
    public function mesmedecins()
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $patientDossierId = $dossier->id;
        $listeMedecins = User::where('role_id', 3)
            ->whereHas('dossierUsers', function ($query) use ($patientDossierId) {
                $query->where('dossier_id', $patientDossierId);
            })
            ->wherenotNull('user_approuved_at')
            ->get();

        return view('patient.medecins.mesmedecins', compact('listeMedecins', 'dossier'));
    }

    public function medecin($id)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $medecin = User::findorFail($id);

        return view('patient.medecins.medecin', compact('dossier','medecin'));
    }

    public function medControle($id_medecin)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();

        $dossier_user = DossierUser::where('dossier_id', $dossier->id)
            ->where('user_id', $id_medecin)
            ->first();

        $restricted_specialties = [];

        if ($dossier_user) {
            $restricted_specialties = DossierUserSpecialite::where('dossier_user_id', '=', $dossier_user->id)->get()
                ->pluck('specialite_id')
                ->toArray();
        }
        return view('patient.medecins.medControle', compact('dossier','id_medecin', 'restricted_specialties'));
    }

    public function storeSpecialties(Request $request, $id)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $dossier_user = DossierUser::firstOrCreate([
            'dossier_id' => $dossier->id,
            'user_id' => $id,
            'deleted_at' => null,
        ]);

        // Remove any existing specialty restrictions for this user
        DossierUserSpecialite::where('dossier_user_id', $dossier_user->id)->delete();

        // Add the selected specialties to the restriction list
        foreach ($request->input('specialties', []) as $specialtyId) {
            $specialty = Specialite::find($specialtyId);
            if ($specialty) {
                $dossier_user_specialite = new DossierUserSpecialite;
                $dossier_user_specialite->dossier_user_id = $dossier_user->id;
                $dossier_user_specialite->specialite_id = $specialty->id;
                $dossier_user_specialite->save();
            }
        }

        return redirect('patient/medecins/mesmedecins');
    }

    public function tousmedecins(Request $request)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $query = User::where('role_id', 3)
            ->whereNotNull('user_approuved_at');

        // Check if a country is selected
        if ($request->has('country') && $request->country !== 'd') {
            $query->where('pays', $request->country);
        }

        // Check if a city is selected
        if ($request->has('ville') && $request->ville !== 'd') {
            $query->where('ville', $request->ville);
        }

        $liste_medecins = $query->get();
        $listVilles = Ville::where("code", Auth::user()->pays)->pluck("name", "code");

        return view('patient.medecins.tousmedecins', compact('liste_medecins', 'listVilles', 'dossier'));
    }

    public function AjouterMedecin($id)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();

        DossierUser::firstOrCreate([
            'user_id' => $id,
            'dossier_id' => $dossier->id,
        ]);

        DossierAccessHistory::create([
            'dossier_id' => $dossier->id,
            'user_id' => $id,
            'granted' => true,
            'created_by' => Auth::user()->id
        ]);
        return redirect('patient/tousmedecins');
    }

    public function deleteMedecin($id)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();

        DossierUser::where('user_id', $id)
            ->where('dossier_id', $dossier->id)->delete();

        DossierAccessHistory::create([
            'dossier_id' => $dossier->id,
            'user_id' => $id,
            'granted' => false,
            'created_by' => Auth::user()->id
        ]);
        return redirect('patient/mesmedecins');
    }
}
