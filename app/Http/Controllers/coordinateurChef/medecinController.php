<?php

namespace App\Http\Controllers\coordinateurChef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Medecin;
use App\Models\Specialite;
use App\Models\Organisme;
use App\Models\Sexe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class medecinController extends Controller
{
    public function index()
    {
       $medecins = Medecin::select(
            'medecins.id',
            'medecins.prenom',
            'medecins.nom',
            's.lib as specialite',
            'v.lib as ville',
            'medecins.pays',
            'o.lib as organisme',
            'medecins.tel',
            'medecins.email'
        )
            ->leftJoin('specialites as s', 'medecins.specialite', '=', 's.id')
            ->leftJoin('villes as v', 'medecins.ville', '=', 'v.id')
            ->leftJoin('organismes as o', 'medecins.organisme', '=', 'o.id')
            ->get();

        return view('coordinateurChef.medecins.index', ['medecins' => $medecins]);
    }
    public function show($id)
    {
        $medecin = Medecin::select(
            'medecins.id',
            'medecins.prenom',
            'medecins.nom',
            's.lib as specialite',
            'v.lib as ville',
            'countries.lib as pays',
            'o.lib as organisme',
            'medecins.tel',
            'medecins.email',
            'medecins.image',
            'sexes.lib as sexe',
            'medecins.url_pacs',
            'medecins.url_bio',
            'medecins.rue',
            'medecins.cp',
            'medecins.created_at',
            'medecins.updated_at'
        )
            ->leftJoin('specialites as s', 'medecins.specialite','=','s.id')
            ->leftJoin('countries', 'medecins.pays','=','countries.code')
            ->leftJoin('villes as v', 'medecins.ville','=','v.id')
            ->leftJoin('organismes as o', 'medecins.organisme','=','o.id')
            ->leftJoin('sexes', 'medecins.sexe','=','sexes.id')
            ->where('medecins.id', '=', $id)->first();
        return view('coordinateurChef.medecins.show', ['medecin' => $medecin]);
    }
    public function create()
    {
        $sexes = Sexe::all();
        $specialites = Specialite::all();
        $organismes = Organisme::all();
        $pays = Country::all();
        return view('coordinateurChef.medecins.create', [
            'specialites' => $specialites,
            'pays' => $pays,
            'sexes' => $sexes,
            'organismes' => $organismes
        ]);
    }
    public function store(Request $request)
    {
        $medecin = new Medecin();
        $medecin->nom = $request->input('nom');
        $medecin->prenom = $request->input('prenom');
        $medecin->tel = $request->input('tel');
        $medecin->email = $request->input('email');
        $medecin->pays = $request->input('pays');
        $medecin->ville = $request->input('state');
        $medecin->cp = $request->input('cp');
        $medecin->rue = $request->input('rue');
        $medecin->specialite = $request->input('specialite');
        $medecin->sexe = $request->input('sexe');
        $medecin->organisme = $request->input('organisme');
        $medecin->dmc = 0;
        $medecin->save();
        return  redirect('/coordinateurChef/medecins/show/' . $medecin->id);
    }
}
