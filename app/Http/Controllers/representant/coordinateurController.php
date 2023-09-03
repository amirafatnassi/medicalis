<?php

namespace App\Http\Controllers\representant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\RepresentantCoordinateur;


class coordinateurController extends Controller
{
    public function index()
    {
        $mesCoordinateurs = RepresentantCoordinateur::select(
            'users.id',
            'users.nom',
            'users.prenom',
            'representant_coordinateur.actif',
            'representant_coordinateur.id as repcoord'
        )
            ->leftJoin('users', 'representant_coordinateur.coordinateur_id', '=', 'users.id')
            ->where('representant_coordinateur.representant_id', '=', auth::user()->id)
            ->where('actif', true)
            ->get();
        $coordinateurs = RepresentantCoordinateur::select(
            'users.id',
            'users.nom',
            'users.prenom',
            'representant_coordinateur.actif',
            'representant_coordinateur.id as repcoord'
        )
            ->leftJoin('users', 'representant_coordinateur.coordinateur_id', '=', 'users.id')
            ->where('representant_coordinateur.representant_id', '=', auth::user()->id)
            ->where('actif', false)
            ->get();
        $others = User::select(
            'users.id',
            'users.nom',
            'users.prenom',
        )
            ->Wherein('users.role_id', [4, 5])
            ->whereNotIn('id', DB::table('representant_coordinateur')
                ->where('representant_id', '=', auth::user()->id)
                ->pluck('coordinateur_id'))
            ->get();

        return view('representant.coordinateurs.index', [
            'mesCoordinateurs' => $mesCoordinateurs,
            'coordinateurs' => $coordinateurs,
            'others' => $others,
        ]);
    }
    public function show($id)
    {
        $medecin = User::select(
            'users.id',
            'users.prenom',
            'users.nom',
            's.lib as specialite',
            'v.lib as ville',
            'countries.lib as pays',
            'users.tel',
            'users.email',
            'users.rue',
            'users.cp',
            'users.created_at',
            'users.updated_at'
        )
            ->leftJoin('specialites as s', 'users.specialite_id', '=', 's.id')
            ->leftJoin('countries', 'users.country_id', '=', 'countries.code')
            ->leftJoin('villes as v', 'users.ville_id', '=', 'v.id')
            ->where('users.id', '=', $id)->first();
        return view('representant.coordinateurs.show', ['medecin' => $medecin]);
    }
    public function activer($id)
    {
        RepresentantCoordinateur::find($id)->update(['actif' => true]);
        return Redirect::back();
    }
    public function ajouter($id)
    {
        $repCoord = new RepresentantCoordinateur();
        $repCoord->representant_id = auth::user()->id;
        $repCoord->coordinateur_id = $id;
        $repCoord->actif = true;
        $repCoord->save();
        return Redirect::back();
    }
    public function supprimer($id)
    {
        RepresentantCoordinateur::find($id)->update([
            'actif' => false
        ]);
        return Redirect::back();
    }
}
