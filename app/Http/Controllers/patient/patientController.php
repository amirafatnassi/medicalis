<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Dossier;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;

class patientController extends Controller
{
    public function profile()
    {
        $patient = User::findorFail(Auth::user()->id);

        return view('patient.profile.profile', compact('patient'));
    }

    public function editMonProfil()
    {
        $patient = User::findorFail(Auth::user()->id);

        return view('patient.profile.editMonProfil', compact('patient'));
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
        
        return view('patient.profile.editmdp', compact('patient'));
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
            return redirect('patient/profile/profile');
        } else {
            return redirect()->back();
        }
    }
}
