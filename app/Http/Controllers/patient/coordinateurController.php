<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Models\Dossier;
use App\Models\DossierUser;
use App\Models\DossierAccessHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class coordinateurController extends Controller
{
    public function index()
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();

        $patientDossierId = $dossier->id;
        $coordinateurs = User::with(['Country', 'Ville', 'Specialite', 'Role'])
            ->where('role_id', 4)
            ->whereNotNull('user_approuved_at')
            ->get();

        return view('patient.coordinateurs.index', compact('coordinateurs', 'dossier'));
    }
    public function show($id)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $coordinateur = User::with('Role', 'Country', 'Ville', 'Profession')
            ->findorFail($id);
        return view('patient.coordinateurs.show', compact('dossier','coordinateur'));
    }


    public function activateCoordinateur(Request $request, $userId)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        DossierUser::firstOrCreate([
            'user_id' => $userId,
            'dossier_id' => $dossier->id,
        ]);
        DossierAccessHistory::create([
            'dossier_id' => $dossier->id,
            'user_id' => $userId,
            'granted' => true,
            'created_by' => Auth::user()->id
        ]);
        return back()->with('success', 'User activated successfully.');
    }

    public function deactivateCoordinateur(Request $request, $userId)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        DossierUser::where('user_id', $userId)
            ->where('dossier_id', $dossier->id)->delete();

        DossierAccessHistory::create([
            'dossier_id' => $dossier->id,
            'user_id' => $userId,
            'granted' => false,
            'created_by' => Auth::user()->id
        ]);
        return back()->with('success', 'User deactivated successfully.');
    }
}
