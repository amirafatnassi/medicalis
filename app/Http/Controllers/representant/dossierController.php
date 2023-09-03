<?php

namespace App\Http\Controllers\representant;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\DossierFile;
use App\Models\DossierUser;
use App\Models\Histeffetmarquant;
use App\Models\Historique;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Redirect;

class dossierController extends Controller
{
	public function index()
	{
		$dossiers = Dossier::select(
			'dossiers.id',
			'dossiers.nom',
			'dossiers.prenom',
			'dossiers.image',
			'c.lib as convention'
		)
			->leftJoin('dossier_users as u', 'dossiers.id', '=', 'u.dossier_id')
			->leftJoin('conventions as c', 'dossiers.convention', '=', 'c.id')
			->WHERE('u.user_id', '=', Auth::user()->id)
			->whereNull('u.deleted_at')
			->get();
		return view('representant.dossiers.index', ['dossiers' => $dossiers]);
	}


	public function dashboard()
	{
		$notifications = auth()->user()->notifications;
		return view('representant.dashboard', [
			'notifications' => $notifications,
			'user' => auth()->user()
		]);
	}

	public function read($id)
	{
		Notification::find($id)->update(['read_at' => now()]);
		return back()->with('flash', 'Notification mark as read');
	}

	public function show($id_dossier)
	{
		$files = DossierFile::where('idDossier', '=', $id_dossier)->get();
		$dossier = Dossier::select(
			'dossiers.id',
			DB::raw("concat(dossiers.nom,' ',dossiers.prenom) as patient"),
			'b.lib as groupe_sanguin',
			'dossiers.taille',
			'dossiers.poids',
			'dossiers.datenaissance',
			'dossiers.lieunaissance',
			'dossiers.tel',
			'dossiers.email',
			'dossiers.contactdurgence',
			'v.lib as ville',
			'dossiers.antecedants_med',
			'dossiers.antecedants_chirg',
			'dossiers.antecedants_fam',
			'dossiers.allergies',
			'dossiers.indicateur_bio',
			'dossiers.traitement_chr',
			's.lib as sexe',
			'dossiers.image',
			'c.lib as pays',
			'dossiers.cp',
			'dossiers.rue',
			'pro.lib as profession',
			'conv.lib as convention',
			'dossiers.created_at',
			'dossiers.updated_at'
		)
			->leftJoin('bloodtypes as b', 'dossiers.groupe_sanguin', '=', 'b.id')
			->leftJoin('professions as pro', 'dossiers.profession', '=', 'pro.id')
			->leftJoin('conventions as conv', 'dossiers.convention', '=', 'conv.id')
			->leftJoin('countries as c', 'dossiers.pays', '=', 'c.code')
			->leftJoin('villes as v', 'dossiers.ville', '=', 'v.id')
			->leftJoin('sexes as s', 'dossiers.sexe', '=', 's.id')
			->WHERE('dossiers.id', '=', $id_dossier)->first();
		return view('representant.dossiers.show', [
			'dossier' => $dossier,
			'files' => $files
		]);
	}
	public function create()
	{
		return view('representant.dossiers.create');
	}
	public function store(Request $request)
	{

		if ($request->input('sexe') == 1) {
			$s = "M";
		} else {
			$s = "F";
		}

		$dossier = new Dossier();
		$request->validate([
			'email' => 'required|email|unique:dossiers,email,' . $dossier->email,
		]);
		$id = IdGenerator::generate([
			'table' => 'dossiers', 'field' => 'id', 'length' => 13,
			'prefix' => \Carbon\Carbon::parse($request->input('datenaissance'))->format('dmY') . $s,
			'reset_on_prefix_change' => true
		]);
		$dossier->id = $id;
		$dossier->groupe_sanguin = $request->input('groupe_sanguin');
		$dossier->taille = $request->input('taille');
		$dossier->poids = $request->input('poids');
		$dossier->prenom = $request->input('prenom');
		$dossier->nom = $request->input('nom');
		$dossier->sexe = $request->input('sexe');
		$dossier->profession = $request->input('profession');
		$dossier->convention = $request->input('convention');
		$dossier->datenaissance = $request->input('datenaissance');
		$dossier->lieunaissance = $request->input('lieunaissance');
		$dossier->tel = $request->input('tel');
		$dossier->email = $request->input('email');
		$dossier->contactdurgence = $request->input('contactdurgence');
		$dossier->pays = $request->input('pays');
		$dossier->ville = $request->input('state');
		$dossier->cp = $request->input('cp');
		$dossier->rue = $request->input('rue');
		$dossier->groupe_sanguin = $request->input('groupe_sanguin');
		$dossier->antecedants_med = $request->input('antecedants_med');
		$dossier->antecedants_chirg = $request->input('antecedants_chirg');
		$dossier->antecedants_fam = $request->input('antecedants_fam');
		$dossier->allergies = $request->input('allergies');
		$dossier->indicateur_bio = $request->input('indicateur_bio');
		$dossier->traitement_chr = $request->input('traitement_chr');
		$dossier->created_by = Auth::user()->id;
		if ($request->hasfile('image')) {
			$file = $request->file('image');
			$filename = $request->input('nom') . '_' . $request->input('prenom') . '.' . $file->getClientOriginalExtension();
			$file->move('uploads/dossier/', $filename);
			$dossier->image = $filename;
		}
		if ($files = $request->file('filesup')) {
			foreach ($files as $img) {
				$img->move('uploads/dossierFiles', $dossier->id_dossier . "-" . time() . "-" . $img->getClientOriginalName());
				$photo = new dossierFile;
				$photo->iddossier = $dossier->id;
				$photo->downloads = $dossier->id_dossier . "-" . time() . "-" . $img->getClientOriginalName();;
				$photo->save();
			}
		}
		$dossier->save();

		$dossierUser = new DossierUser();
		$dossierUser->dossier_id = $id;
		$dossierUser->user_id = Auth::user()->id;
		$dossierUser->save();

		return redirect('representant/dossiers/index');
	}

	public function edit($id_dossier)
	{
		$dossier = Dossier::select(
			'dossiers.id',
			'dossiers.nom',
			'dossiers.prenom',
			'dossiers.groupe_sanguin',
			'b.lib as groupe_sanguin_lib',
			'dossiers.taille',
			'dossiers.sexe',
			'dossiers.sexe as sexe_id',
			's.lib as sexe_lib',
			'dossiers.poids',
			'dossiers.datenaissance',
			'dossiers.lieunaissance',
			'dossiers.tel',
			'dossiers.email',
			'dossiers.profession',
			'pro.lib as profession_lib',
			'dossiers.convention',
			'conv.lib as convention_lib',
			'dossiers.contactdurgence',
			'dossiers.pays',
			'c.lib as pays_lib',
			'dossiers.ville as ville',
			'v.lib as ville_lib',
			'dossiers.antecedants_med',
			'dossiers.antecedants_chirg',
			'dossiers.antecedants_fam',
			'dossiers.allergies',
			'dossiers.indicateur_bio',
			'dossiers.traitement_chr',
			'dossiers.image',
			'dossiers.cp',
			'dossiers.rue',
			'dossiers.created_at',
			'dossiers.updated_at'
		)
			->leftJoin('bloodtypes as b', 'dossiers.groupe_sanguin', '=', 'b.id')
			->leftJoin('professions as pro', 'dossiers.profession', '=', 'pro.id')
			->leftJoin('conventions as conv', 'dossiers.convention', '=', 'conv.id')
			->leftJoin('countries as c', 'dossiers.pays', '=', 'c.code')
			->leftJoin('villes as v', 'dossiers.ville', '=', 'v.id')
			->leftJoin('sexes as s', 'dossiers.sexe', '=', 's.id')
			->WHERE('dossiers.id', '=', $id_dossier)->first();
		$files = DossierFile::where('idDossier', '=', $id_dossier)->get();
		return view('representant.dossiers.edit', [
			'dossier' => $dossier,
			'files' => $files,
		]);
	}

	public function update_personal(Request $request, $id)
	{
		$dossier = Dossier::where('id', $id)->firstOrFail();
		$dossier->prenom = $request->input('prenom');
		$dossier->nom = $request->input('nom');
		$dossier->profession = $request->input('profession');
		$dossier->lieunaissance = $request->input('lieunaissance');
		$dossier->tel = $request->input('tel');
		$dossier->email = $request->input('email');
		$dossier->contactdurgence = $request->input('contactdurgence');
		if ($request->hasfile('image')) {
			$file = $request->file('image');
			$filename = $request->input('nom') . '-' . $request->input('prenom') . "-" . time() . '.' . $file->getClientOriginalExtension();
			$file->move('uploads/dossier/', $filename);
			$dossier->image = $filename;
		}
		$dossier->save();
		return  redirect('/representant/dossiers/show/' . $id);
	}

	public function update_adress(Request $request, $id)
	{
		$dossier = Dossier::where('id', $id)->firstOrFail();
		$dossier->pays = $request->input('pays');
		$dossier->ville = $request->input('state');
		$dossier->cp = $request->input('cp');
		$dossier->rue = $request->input('rue');
		$dossier->save();
		return  redirect('/representant/dossiers/show/' . $id);
	}

	public function update_general(Request $request, $id)
	{
		$dossier = Dossier::where('id', $id)->firstOrFail();
		$dossier->groupe_sanguin = $request->input('groupe_sanguin');
		$dossier->taille = $request->input('taille');
		$dossier->poids = $request->input('poids');
		$dossier->convention = $request->input('convention');
		$dossier->groupe_sanguin = $request->input('groupe_sanguin');
		$dossier->save();
		return  redirect('/representant/dossiers/show/' . $id);
	}

	public function update_medical(Request $request, $id)
	{
		$dossier = Dossier::where('id', $id)->firstOrFail();
		$dossier->antecedants_med = $request->input('antecedants_med');
		$dossier->antecedants_chirg = $request->input('antecedants_chirg');
		$dossier->antecedants_fam = $request->input('antecedants_fam');
		$dossier->allergies = $request->input('allergies');
		$dossier->indicateur_bio = $request->input('indicateur_bio');
		$dossier->traitement_chr = $request->input('traitement_chr');
		$dossier->save();
		return  redirect('/representant/dossiers/show/' . $id);
	}

	public function update_files(Request $request, $id)
	{
		if ($files = $request->file('filesup')) {
			foreach ($files as $img) {
				$profileImage = $id . "-" . time() . "-" . $img->getClientOriginalName();
				$img->move('uploads/dossierFiles', $profileImage);
				$photo = new dossierFile;
				$photo->iddossier = $id;
				$photo->downloads = $profileImage;
				$photo->save();
			}
		}
		return  redirect('/representant/dossiers/show/' . $id);
	}

	public function deleteFile($id)
	{
		$file = DB::select(DB::raw('select * from dossierfiles where id=' . $id));
		$filename = $file[0]->downloads;
		unlink(public_path('../public/uploads/dossierFiles/' . $filename));
		DB::delete('delete from dossierfiles where id=' . $id);
		return Redirect::back();
	}

	public function deleteDossier($id)
	{
		DossierUser::where('dossier_id', '=', $id)->delete();
		return Redirect::back();
	}

	public function historiques($id_dossier)
	{
		$dossier = Dossier::findorfail($id_dossier);
		$resultats = Historique::select(
			'historiques.id',
			'historiques.downloads',
			'historiques.type',
			'historiques.date',
			'historiques.motif',
			'historiques.taille',
			'historiques.poids',
			'historiques.ta',
			'historiques.observation',
			'historiques.id_medecin',
			'historiques.dossier',
			'historiques.specialite',
			'historiques.url_pacs',
			'historiques.remarques',
			'specialites.lib',
			DB::raw("concat(users.prenom,' ',users.nom) as user ")
		)
			->leftJoin('specialites', 'historiques.id_specialite', '=', 'specialites.id')
			->leftJoin('users', 'users.id', '=', 'historiques.created_by')
			->where('historiques.dossier', '=', $id_dossier)
			->orderBy('historiques.date', 'DESC')
			->get();
		return view('representant.dossiers.historiques', [
			'resultats' => $resultats,
			'dossier' => $dossier
		]);
	}
	public function monHistorique($id_dossier)
	{
		$dossier = Dossier::findorfail($id_dossier);
		$resultats = Historique::select(
			'historiques.id',
			'historiques.downloads',
			'historiques.type',
			'historiques.date',
			'historiques.motif',
			'historiques.taille',
			'historiques.poids',
			'historiques.ta',
			'historiques.observation',
			'historiques.id_medecin',
			'historiques.dossier',
			'historiques.specialite',
			'historiques.url_pacs',
			'historiques.remarques',
			DB::raw("concat(users.prenom,' ',users.nom) as user")
		)
			->leftJoin('users', 'users.id', '=', 'historiques.created_by')
			->where('historiques.dossier', '=', $id_dossier)
			->where('historiques.created_by', '=', Auth::user()->id)
			->orderBy('date', 'DESC')
			->get();
		return view('representant.dossiers.monHistorique', [
			'resultats' => $resultats,
			'dossier' => $dossier
		]);
	}

	public function effetsmarquants($id_dossier)
	{
		$resultats = Consultation::select(
			'consultations.id',
			'consultations.date',
			'consultations.observation',
			'consultations.effet_marquant_txt',
			DB::raw("count('consultationfiles.downloads')")
		)
			->leftJoin('dossier_users as d', 'consultations.id_dossier', '=', 'd.dossier_id')
			->leftJoin('medecins as m', 'consultations.id_medecin', '=', 'm.id')
			->leftJoin('specialites as s', 'm.specialite', '=', 's.id')
			->leftJoin('consultationfiles', 'consultationfiles.idConsultation', '=', 'consultations.id')
			->where('consultations.effet_marquant', '=', 1)
			->where('consultations.id_dossier', '=', $id_dossier)
			->whereNotIn('consultations.id', DB::table('histeffetmarquants')->pluck('id_consultation')->toArray())
			->groupBy(
				'consultations.id',
				'consultations.date',
				'consultations.observation',
				'consultations.effet_marquant_txt'
			)
			->get();
		$dossier = Dossier::findorfail($id_dossier);
		return view('representant.dossiers.effetsmarquants', [
			'liste_consultations' => $resultats,
			'dossier' => $dossier
		]);
	}

	public function deleteHistorique($id)
	{
		$Histeffetmarquant = new Histeffetmarquant();
		$Histeffetmarquant->id_consultation = $id;
		$Histeffetmarquant->id_user = Auth::user()->id;
		$Histeffetmarquant->save();
		$consultation = Consultation::find($id);
		$consultation->effet_marquant = 0;
		$consultation->save();
		return Redirect::back();
	}

	public function listeSupprimer($id_dossier)
	{
		$results = Histeffetmarquant::select(
			'histeffetmarquants.deleted_at',
			'c.id',
			'c.observation',
			'c.date',
			'm.nom',
			'm.prenom',
			'c.id_dossier'
		)
			->leftJoin('consultations as c', 'histeffetmarquants.id_consultation', '=', 'c.id')
			->leftJoin('medecins as m', 'histeffetmarquants.id_user', '=', 'm.id')
			->leftJoin('specialites as s', 'm.specialite', '=', 's.id')
			->get();
		$dossier = Dossier::findorfail($id_dossier);
		return view('representant.dossiers.listeSupprimer', [
			'liste_consultations' => $results,
			'dossier' => $dossier
		]);
	}

	public function rechercher()
	{
		return view('representant.dossiers.rechercher');
	}

	public function getrechercher(Request $request)
	{
		$dossier = $request->input('dossier');
		$nom = $request->input('nom');
		$prenom = $request->input('prenom');
		$datenaissance = $request->input('datenaissance');
		$email = $request->input('email');
		$pays = $request->input('pays');
		$state = $request->input('state');
		$dossiers = Dossier::where('id', '=', $dossier)
			->orWhere('nom', '=', $nom)
			->where('prenom', '=', $prenom)
			->orWhere('datenaissance', '=', $datenaissance)
			->orwhere('email', '=', $email)
			->orwhere('pays', '=', $pays)
			->orwhere('ville', '=', $state)
			->get();
		return view('representant.dossiers.getdossier', ['dossiers' => $dossiers]);
	}

	public function ajouterdossier($id)
	{
		$dossierUser = new DossierUser();
		$dossierUser->dossier_id = $id;
		$dossierUser->user_id = Auth::user()->id;
		$dossierUser->save();
		return redirect('representant/dossiers/index');
	}
}
