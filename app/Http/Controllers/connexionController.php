<?php

namespace App\Http\Controllers;

use App\Mail\EmailConfirmation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Mail\motdepasseoubliepatient;
use App\Models\Dossier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class connexionController extends Controller
{

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }


    public function enregistrer(request $req)
    {
        $validator = Validator::make($req->all(), [
            'sexe_id' => 'required',
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'role_id' => 'required',
            'datenaissance' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/',
        ], [
            'sexe_id.required' => 'Le champ sexe est requis.',
            'prenom.required' => 'Le champ prénom est requis.',
            'nom.required' => 'Le champ nom est requis.',
            'role_id.required' => 'Le champ role est requis.',
            'datenaissance.required' => 'Le champ date de naissance est requis.',
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'email.max' => 'L\'email ne peut pas dépasser :max caractères.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le champ mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial (@, #, $, etc.).',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Generate a unique token
        $token = Str::random(60);

        $user = User::create([
            'country_id' => $req->input('pays'),
            'ville_id' => $req->input('ville'),
            'password' => Hash::make($req->input('password')),
            'verification_token' => $token,
        ] + $req->all());

        Mail::to($user->email)->send(new EmailConfirmation($user));

        return redirect('/');
    }

    /////////// patients  ////////

    public function motdepasseoubliepatient()
    {
        return view('motpassePatient');
    }

    public function recuperemotdepasseoubliepatient(Request $request)
    {
        $mail = $request->mail;
        $dossier = Dossier::where('email', '=', $mail)->first();
        if ($dossier === null) {
            return Redirect::back();
        } else {
            $data = array(
                'name' => "Cher Patient",
                'message' => "suite à votre demande veuillez utilisez ce lien pour récupérer votre mot de passe",
            );
            \Mail::to($mail)->send(new motdepasseoubliepatient($data));
            return redirect('/formulaireemotdepasseoubliepatient');
        }
    }

    public function formulaireemotdepasseoubliepatient()
    {
        return view('formulaireemotdepasseoubliepatient');
    }

    public function reinisialisermotdepasseoubliepatient(Request $request)
    {
        $mail = $request->mail;
        $dossier = Dossier::where('email', '=', $mail)->first();
        $dossier->password = Hash::make($request->input('pwd'));
        $dossier->save();
        return redirect('/loginPatient');
    }

    ////// medecin ////

    public function motdepasseoubliemedecin()
    {
        return view('motpasseMedecin');
    }
}
