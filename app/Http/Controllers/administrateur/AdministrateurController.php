<?php

namespace App\Http\Controllers\Administrateur;

use App\Http\Controllers\Controller;
use App\Mail\SubscriptionConfirmation;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Mail;

class AdministrateurController extends Controller
{

    public function index()
    {
        return view('administrateur.admin');
    }

    // demandes patients //

    public function demandePatients()
    {
        $liste_demande = User::with('Sexe', 'Profession', 'country', 'Ville')
            ->where('role_id', 2)
            ->whereNull('user_approuved_at')
            ->get();
        return view('administrateur.demandePatients', compact('liste_demande'));
    }

    public function approuverPatients($id)
    {
        $user = User::findOrFail($id);
        $user->update(['user_approuved_at' => now(), 'user_approuved_by' => auth::user()->id]);

        $s = ($user->Sexe->lib == 'Masculin') ? 'M' : 'F';
        $i = IdGenerator::generate([
            'reset_on_prefix_change' => true,
            'table' => 'dossiers', 'field' => 'id', 'length' => 13,
            'prefix' => \Carbon\Carbon::parse($user->datenaissance)->format('dmY') . $s,
            'reset_on_prefix_change' => true
        ]);
        $doss = new Dossier([
            'id' => $i,
            'user_id' => $user->id,
            'groupe_sanguin' => $user->groupe_sanguin,
            'taille' => $user->taille,
            'poids' => $user->poids,
        ]);
        $doss->save();
        Mail::to($user->email)->send(new SubscriptionConfirmation($user));

        return redirect('/administrateur/demandePatients');
    }

    public function annulerPatients($id)
    {
        $user  = User::findOrFail($id);
        $user->update(['approuver' => 2]);

        return redirect('/administrateur/demandePatients');
    }

    public function showPatient($id_patient)
    {
        $Patient = User::with('Sexe', 'Ville', 'country', 'Profession')
            ->findorFail($id_patient);
        return view('administrateur.showPatient', compact('Patient'));
    }

    // demandes medecins //

    public function demandeMedecins()
    {
        $liste_demande = User::with('Sexe', 'Profession', 'country', 'Ville')
            ->where('role_id', 2)
            ->whereNull('user_approuved_at')
            ->get();
        return view('administrateur.demandeMedecins', compact('liste_demande'));
    }

    public function approuverMedecin($id)
    {
        $user = User::findorFail($id);
        $user->update(['user_approuved_at' => now(), 'user_approuved_by' => auth::user()->id]);
        
        Mail::to($user->email)->send(new SubscriptionConfirmation($user));

        return redirect('/administrateur/demandeMedecins');
    }

    public function annulerMedecins($id)
    {
        $medecin = User::findOrFail($id);
        $medecin->update(['approuver' => 2]);
        return redirect('/administrateur/demandeMedecins');
    }

    public function showMedecin($id_medecin)
    {
        $Medecin = User::with('Specialite', 'Organisme', 'Sexe', 'country', 'Ville')
            ->findorFail($id_medecin);
        return view('administrateur.showMedecin', compact('Medecin'));
    }

    // profile //

    public function myProfil()
    {
        $user = User::findorFail(auth::user()->id);
        return view('administrateur.profile', compact('user'));
    }

    public function update_general(Request $request)
    {
        $user = User::FindOrFail(auth::user()->id);
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->tel = $request->input('tel');
        $user->email = $request->input('email');
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $id_image = $request->input('nom') . '-' . $request->input('prenom');
            $filename = $id_image . "-" . time() . '.' . $extension;
            $file->move('uploads/users/', $filename);
            $user->image = $filename;
        }
        $user->save();

        return redirect('representant/myProfil');
    }

    public function update_information(Request $request)
    {
        $user = User::FindOrFail(auth::user()->id);
        $user->sexe = $request->input('sexe_id');
        $user->country_id = $request->input('pays');
        $user->ville_id = $request->input('state');
        $user->cp = $request->input('cp');
        $user->rue = $request->input('rue');
        $user->save();

        return redirect('representant/myProfil');
    }

    public function updatemdp(Request $req)
    {
        $user = User::find(auth::user()->id);
        $valid = validator($req->only('ampd', 'nmpd', 'cmpd'), [
            'ampd' => 'required|string',
            'nmpd' => 'required|string|different:ampd',
            'cmpd' => 'required_with:nmpd|same:nmpd|string',
        ], [
            'nmpd.required_with' => 'Retapez le nouveau mot de passe.'
        ]);

        if ($valid->fails()) {
            return response()->json([
                'errors' => $valid->errors(),
                'message' => 'Erreur.',
                'status' => false
            ], 200);
        }
        $mdp = $user->password;
        $ampd = $req->input('ampd');
        if (Hash::check($ampd, $mdp)) {
            $user->password = Hash::make($req->input('nmpd'));
            $user->save();
            return redirect('/representant/myProfil');
        } else {
            return redirect()->back();
        }
    }
}
