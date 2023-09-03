<?php

namespace App\Http\Controllers\Administrateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\DossierFile;
use App\Models\DossierUser;
use App\Models\Histeffetmarquant;
use App\Models\Consultation;
use App\Models\Examenradio;
use App\Models\Examenbio;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Redirect;

class dossierController extends Controller
{
	public function dashboard()
	{
		$notifications = auth()->user()->notifications;
		return view('administrateur.dashboard', compact('notifications'));
	}

	public function index()
	{
		$dossiers = Dossier::all();
		return view('administrateur.dossiers.index', compact('dossiers'));
	}

	public function read($id)
	{
		Notification::find($id)->update(['read_at' => now()]);
		return back()->with('flash', 'Notification mark as read');
	}

	public function show($id_dossier)
	{
		$dossier = Dossier::with(['bloodtype', 'Profession', 'country', 'ville', 'sexe', 'files'])
			->findorFail($id_dossier);

		// $files = DossierFile::where('idDossier', '=', $id_dossier)->get();
		return view('administrateur.dossiers.show', compact('dossier'));
	}

	public function create()
	{
		return view('administrateur.dossiers.create');
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

		return redirect('administrateur/dossiers/index');
	}

	public function edit($id_dossier)
	{
		$dossier = Dossier::select(
			'dossiers.*',
			'b.lib as groupe_sanguin_lib',
			's.lib as sexe_lib',
			'pro.lib as profession_lib',
			'c.lib as pays_lib',
			'v.name as ville_lib'
		)
			->leftJoin('bloodtypes as b', 'dossiers.groupe_sanguin', '=', 'b.id')
			->leftJoin('professions as pro', 'dossiers.profession', '=', 'pro.id')
			->leftJoin('countries as c', 'dossiers.pays', '=', 'c.code')
			->leftJoin('villes as v', 'dossiers.ville', '=', 'v.id_ville')
			->leftJoin('sexes as s', 'dossiers.sexe', '=', 's.id')
			->where('dossiers.id', $id_dossier)
			->firstOrFail();
		$files = DossierFile::where('idDossier', $id_dossier)->get();

		return view('administrateur.dossiers.edit', compact('dossier', 'files'));
	}

	public function update_personal(Request $request, $id)
	{
		if ($request->hasfile('avatar')) {
			$request->validate([
				'avatar' => ['required', 'image', 'mimes:jpg,png', 'max:2048'], // max size is 2MB, only allow JPG and PNG files
			]);
		}
		$dossier = Dossier::findorFail($id);
		$dossier->fill($request->only([
			'prenom',
			'nom',
			'profession',
			'lieunaissance',
			'tel',
			'email',
			'contactdurgence',
		]));

		if ($request->hasfile('avatar')) {
			$file = $request->file('avatar');
			$filename = $request->input('nom') . '-' . $request->input('prenom') . "-" . time() . '.' . $file->getClientOriginalExtension();
			$file->move('uploads/dossier/', $filename);
			$dossier->image = basename($filename); // save only the filename without the path
		}
		$dossier->save();
		return  redirect('/administrateur/dossiers/show/' . $id);
	}

	public function update_adress(Request $request, $id)
	{
		$dossier = Dossier::findorFail($id);
		$dossier->fill($request->only([
			'pays',
			'ville',
			'cp',
			'rue'
		]));
		$dossier->save();
		return  redirect('/administrateur/dossiers/show/' . $id);
	}

	public function update_general(Request $request, $id)
	{
		$dossier = Dossier::findorFail($id);
		$dossier->fill($request->only([
			'groupe_sanguin',
			'taille',
			'poids',
			'groupe_sanguin'
		]));
		$dossier->save();
		return  redirect('/administrateur/dossiers/show/' . $id);
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
		return  redirect('/administrateur/dossiers/show/' . $id);
	}

	public function update_files(Request $request, $id)
	{
		if ($files = $request->file('files')) {
			foreach ($files as $img) {
				$profileImage = $id . "-" . time() . "-" . $img->getClientOriginalName();
				$img->move('uploads/dossierFiles', $profileImage);
				$photo = new dossierFile;
				$photo->iddossier = $id;
				$photo->downloads = $profileImage;
				$photo->save();
			}
		}
		return  redirect('/administrateur/dossiers/show/' . $id);
	}

	public function deleteFile($id)
	{
		$file = DossierFile::findorFail($id);
		if ($file) {
			unlink(public_path('../public/uploads/dossierFiles/' . $file->downloads));
			$file->delete();
		}
		return Redirect::back();
	}

	public function deleteDossier($id)
	{
		DossierUser::where('dossier_id', '=', $id)->delete();
		return Redirect::back();
	}

	public function historiques($id_dossier)
	{
		$dossier = Dossier::findorFail($id_dossier);

		$consultation = Consultation::with('motif', 'medecin', 'files')
			->select('*', DB::raw("'consultation' as type"))
			->where('id_dossier', $id_dossier)
			->where('id_medecin', Auth::user()->id)
			->orWhere('remarques', "saisie par le patient !")
			->orderBy('date', 'desc')
			->get();

		$examenBio = Examenbio::with('medecin', 'files')
			->select('*', DB::raw("'examenbio' as type"))
			->where('dossier', $id_dossier)
			->where('id_medecin', Auth::user()->id)
			->orWhere('remarques', "saisie par le patient !")
			->orderBy('date', 'desc')
			->get();

		$examenRadio = Examenradio::with('medecin', 'files')
			->select('*', DB::raw("'examenradio' as type"))
			->where('dossier', $id_dossier)
			->where('id_medecin', Auth::user()->id)
			->orWhere('remarques', "saisie par le patient !")
			->orderBy('date', 'desc')
			->get();
		return view('administrateur.dossiers.historiques', compact('consultation', 'examenBio', 'examenRadio', 'dossier'));
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
		return view('administrateur.dossiers.monHistorique', [
			'resultats' => $resultats,
			'dossier' => $dossier
		]);
	}

	public function effetsmarquants($id_dossier)
	{
		$liste_consultations = Consultation::with('files', 'medecin','motif')
			->where('effet_marquant', 1)
			->where('id_dossier', $id_dossier)
			->whereNotIn('id', DB::table('histeffetmarquants')->pluck('id_consultation')->toArray())
			->orderBy('date', 'desc')
			->get();

		$dossier = Dossier::findorFail($id_dossier);

		return view('administrateur.dossiers.effetsmarquants',compact('liste_consultations','dossier'));
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
			->leftJoin('medecins as m', 'histeffetmarquants.id_medecin', '=', 'm.id')
			->leftJoin('specialites as s', 'm.specialite', '=', 's.id')
			->get();
		$dossier = Dossier::findorfail($id_dossier);
		return view('administrateur.dossiers.listeSupprimer', [
			'liste_consultations' => $results,
			'dossier' => $dossier
		]);
	}

	public function rechercher()
	{
		return view('administrateur.dossiers.rechercher');
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
		return view('administrateur.dossiers.getdossier', ['dossiers' => $dossiers]);
	}

	public function ajouterdossier($id)
	{
		$dossierUser = new DossierUser();
		$dossierUser->dossier_id = $id;
		$dossierUser->user_id = Auth::user()->id;
		$dossierUser->save();
		return redirect('administrateur/dossiers/index');
	}
}
