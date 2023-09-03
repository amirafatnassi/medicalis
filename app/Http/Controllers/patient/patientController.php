<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Dossier;
use App\Models\DossierUser;
use App\Models\DossierUserSpecialite;
use App\Models\Models\DossierAccessHistory;
use App\Models\Specialite;
use App\Models\User;
use App\Models\Ville;
use Auth;
use Illuminate\Support\Facades\Validator;

class patientController extends Controller
{
    public function editmondossier()
    {
        if (Auth::check()) {
            $dossier = Dossier::with('user')->where('user_id', Auth::user('patient')->id)->first();
        }
        return view('patient.editmondossier', compact('dossier'));
    }

    public function updatemondossier(Request $request)
    {
        $patient = Dossier::FindOrFail(Auth::user('patient')->id);
        $patient->fill($request->only([
            'nom', 'prenom', 'lieunaissance', 'tel', 'email', 'profession',
            'contactdurgence', 'pays', 'ville', 'cp', 'rue'
        ]));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $id_image = $request->input('nom') . '_' . $request->input('prenom') . '_' . $patient->id;
            $filename = $id_image . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/dossier/', $filename);
            $patient->image = $filename;
        }

        $patient->save();

        return redirect('patient/mondossier');
    }


    public function destroy(Request $request, $id)
    {
        $liste_demande = Dossier::find($id);
        $data = array('name' => "cher " . $liste_demande->nom . " " . $liste_demande->prenom, 'message' => "Vous ete supprimer de platforme DMP !!");
        Mail::to($liste_demande->email)->send(new SecuriteMailPatient($data));
        Patient::destroy($id);
        return redirect()->route('patients.index');
    }

    public function profile()
    {
        $patient = User::with('Country', 'Ville', 'Sexe')->findorFail(Auth::user()->id);
        return view('patient.profile', compact('patient'));
    }

    public function editMonProfil()
    {
        $patient = User::with('Sexe', 'Country', 'Ville')->findorFail(Auth::user()->id);
        return view('patient.editMonProfil', compact('patient'));
    }

    public function updateProfil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sexe_id' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'sexe_id' => 'required',
            'datenaissance' => 'required',
            'email' => 'required',
            'ville' => 'required',
            'pays' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'sexe_id.required' => 'Le champ sexe est requis.',
            'nom.required' => 'Le champ nom est requis.',
            'prenom.required' => 'Le champ prénom est requis.',
            'datenaissance.required' => 'Le champ date de naissance est requis.',
            'email' => 'Le champ email est requis.',
            'ville' => 'Le champ ville est requis.',
            'pays' => 'Le champ pays est requis.',
            'image' => 'Le champ :attribute doit être une image au format jpeg, png, jpg ou gif et ne pas dépasser 2048 Ko.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'sexe_id' => $request->input('sexe_id'),
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'country_id' => $request->input('pays'),
            'ville_id' => $request->input('ville'),
            'lieunaissance' => $request->input('lieunaissance'),
            'cp' => $request->input('cp'),
            'rue' => $request->input('rue'),
        ];
        $patient = User::findorFail(Auth::user()->id);
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $dossier->id . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/users/', $filename);
            $data['image'] = $filename;
        }

        $patient->update($data);
        return redirect('patient/profile');
    }

    public function editmdp()
    {
        $patient = User::findorFail(Auth::user()->id);
        return view('patient.editmdp', compact('patient'));
    }

    public function storeeditmdp(Request $req, $id)
    {
        $user = Dossier::where(Auth::user('patient')->id)->first();
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
            return redirect('/patient/profile');
        } else {
            return redirect()->back();
        }
    }

    public function mondossier()
    {
        if (Auth::check()) {
            $dossier = Dossier::with('user', 'bloodtype')->where('user_id', Auth::user()->id)->first();
        }
        return view('patient.mondossier', compact('dossier'));
    }

    public function mesmedecins()
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $patientDossierId = $dossier->id;
        $listeMedecins = User::with(['Country', 'Ville', 'Specialite'])
            ->where('role_id', 3)
            ->whereHas('dossierUsers', function ($query) use ($patientDossierId) {
                $query->where('dossier_id', $patientDossierId);
            })
            ->wherenotNull('user_approuved_at')
            ->get();

        return view('patient.mesmedecins', compact('listeMedecins', 'dossier'));
    }

    public function medecin($id_medecin)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $medecin = User::with('Organisme', 'Specialite', 'Ville', 'Country')->findorFail($id_medecin);
        return view('patient.medecin', compact('dossier','medecin'));
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
        return view('patient.medControle', compact('dossier','id_medecin', 'restricted_specialties'));
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
        return redirect('patient/mesmedecins')->with('success', 'Specialties restrictions updated successfully.');
    }

    public function tousmedecins(Request $request)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $query = User::with(['Country', 'Specialite', 'Ville', 'Organisme'])
            ->where('role_id', 3)
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

        return view('patient.tousmedecins', compact('liste_medecins', 'listVilles', 'dossier'));
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
        return redirect('patient/tousmedecins',compact('dossier'));
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
