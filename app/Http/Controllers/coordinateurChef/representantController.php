<?php
namespace App\Http\Controllers\coordinateurChef;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\RepresentantCoordinateur;

class representantController extends Controller
{
    public function index()
    {
        $mesRepresentants = RepresentantCoordinateur::select(
            'users.id',
            'users.nom',
            'users.prenom',
            'representant_coordinateur.actif',
            'representant_coordinateur.id as repcoord'
        )
            ->leftJoin('users', 'representant_coordinateur.representant_id', '=', 'users.id')
            ->where('representant_coordinateur.coordinateur_id', '=', auth::user()->id)
            ->where('actif', true)
            ->get();
        $representants = RepresentantCoordinateur::select(
            'users.id',
            'users.nom',
            'users.prenom',
            'representant_coordinateur.actif',
            'representant_coordinateur.id as repcoord'
        )
            ->leftJoin('users', 'representant_coordinateur.representant_id', '=', 'users.id')
            ->where('representant_coordinateur.coordinateur_id', '=', auth::user()->id)
            ->where('actif', false)
            ->get();
        $others = User::select(
            'users.id',
            'users.nom',
            'users.prenom',
        )->where('users.role_id', '=', 1)
            ->whereNotIn('id', DB::table('representant_coordinateur')->where('coordinateur_id', '=', auth::user()->id)->pluck('representant_id'))
            ->get();
        return view('coordinateurChef.representants.index', [
            'mesRepresentants' => $mesRepresentants,
            'representants' => $representants,
            'others' => $others
        ]);
    }
    public function show($id)
    {
        $representant = User::select(
            'users.id',
            'users.prenom',
            'users.nom',
            'users.tel',
            'users.email',
            'users.rue',
            'users.cp',
            'countries.lib as pays',
            'v.lib as ville',
            'users.cp',
            'users.fonction',
            'users.lieuTravail',
            'users.created_at',
            'users.updated_at'
        )
            ->leftJoin('countries', 'users.country_id', '=', 'countries.code')
            ->leftJoin('villes as v', 'users.ville_id', '=', 'v.id')
            ->where('users.id', '=', $id)->first();
        return view('coordinateurChef.representants.show', ['representant' => $representant]);
    }

    public function activer($id)
    {
        RepresentantCoordinateur::find($id)->update([
            'actif' => true
        ]);

        return Redirect::back();
    }
    public function ajouter($id)
    {
        $repCoord = new RepresentantCoordinateur();
        $repCoord->representant_id = $id;
        $repCoord->coordinateur_id = auth::user()->id;
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
