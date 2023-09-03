<?php

namespace App\Http\Controllers\coordinateurChef;

use App\Http\Controllers\Controller;
use App\Models\CoordinateurCoordinateurChef;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class coordinateurController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $coordinateurs = $user->supervisedUsers;

        return view('coordinateurChef.coordinateurs.index', compact('coordinateurs'));
    }
    public function show($id)
    {
        $coordinateur = User::with('Sexe', 'Organisme', 'Ville', 'Country','Role')
            ->findorFail($id);
        return view('coordinateurChef.coordinateurs.show', compact('coordinateur'));
    }

    // public function ajouter($id)
    // {
    //     $coord = new CoordinateurCoordinateurChef();
    //     $coord->coordinateur_id = $id;
    //     $coord->coordinateurChef_id = auth::user()->id;
    //     $coord->actif = true;
    //     $coord->save();
    //     return Redirect::back();
    // }

    // public function activer($id)
    // {
    //     CoordinateurCoordinateurChef::find($id)->update(['actif' => true]);
    //     return Redirect::back();
    // }
    // public function supprimer($id)
    // {
    //     CoordinateurCoordinateurChef::find($id)->update(['actif' => false]);
    //     return Redirect::back();
    // }
}
