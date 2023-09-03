<?php

namespace App\Http\Controllers\coordinateurChef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Dossier;
use App\Models\DemandeConsultation;
use App\Models\AffectationDemandeConsultation;
use App\Models\CoordinateurCoordinateurChef;
use App\Models\User;
use App\Models\DossierCoordinateur;
use App\Models\Notification;
use App\Models\DemandeConsFiles;
use App\Models\DemandeDevis;
use App\Models\DemandeInfos;
use App\Models\DemandeInfosFiles;
use App\Models\RepDemandeInfos;
use App\Models\RepDemandeInfosFiles;
use App\Models\TypeDemande;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class demandeConsController extends Controller
{
	public function create($id_dossier)
	{
		$users = User::all();
		$types_demandes = TypeDemande::all();
		$dossier = Dossier::findorfail($id_dossier);
		$coordinateurs = User::where('role_id', '=', 5)->get();
		return view('coordinateurChef.demandeCons.create', [
			'dossier' => $dossier,
			'users' => $users,
			'types_demandes' => $types_demandes,
			'coordinateurs' => $coordinateurs,
		]);
	}
	public function index()
	{
		$dossiers = Dossier::select(
			'dossiers.id',
			'nom',
			'prenom',
			'image',
			'c.lib as convention',
			DB::raw("count(demande_consultation.id) as nb_demandes"),
			'dossiers.created_by'
		)
			->leftJoin('dossier_coordinateurs as u', 'dossiers.id', '=', 'u.dossier_id')
			->leftJoin('conventions as c', 'convention', '=', 'c.id')
			->leftJoin('demande_consultation', 'demande_consultation.dossier_id', '=', 'dossiers.id')
			->WHERE('u.user_id', '=', Auth::user()->id)
			->whereNull('u.deleted_at')
			->groupBy(
				'dossiers.id',
				'nom',
				'prenom',
				'image',
				'c.lib',
				'dossiers.created_by'
			)
			->get();
		return view('coordinateurChef.demandeCons.index', [
			'dossiers' => $dossiers,
		]);
	}

	public function show($id_dossier)
	{
		$dossier = Dossier::findorfail($id_dossier);
		$demandes = DemandeConsultation::select(
			'demande_consultation.id',
			'status_demandes.lib as status',
			'demande_consultation.coordinateur_en_charge',
			DB::raw("concat(users.prenom,' ',users.nom) as coordinateurEnCharge"),
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'demande_consultation.status_id'
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_consultation.status_id')
			->leftJoin('users', 'users.id', '=', 'demande_consultation.coordinateur_en_charge')
			->leftJoin('users as u', 'u.id', '=', 'demande_consultation.created_by')
			->where('dossier_id', '=', $id_dossier)
			->get();
		return view('coordinateurChef.demandeCons.show', [
			'dossier' => $dossier,
			'demandes' => $demandes
		]);
	}

	public function liste_demandes_infos($id)
	{
		$var = DemandeConsultation::find($id)->coordinateur_en_charge;
		if ($var !== auth::user()->id) {
			abort(403, 'Unauthorized action.');
		}
		$demandes = DemandeInfos::select(
			'demande_infos.id',
			'status_demandes.lib as status',
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'demande_infos.status_id',
			'demande_infos.observation',
			DB::raw("count(demande_infos_files.downloads) as downloads"),
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_infos.status_id')
			->leftJoin('users as u', 'u.id', '=', 'demande_infos.created_by')
			->leftJoin('demande_infos_files', 'demande_infos_files.idDemandeInfos', '=', 'demande_infos.id')
			->where('demande_cons_id', '=', $id)
			->groupBy(
				'demande_infos.id',
				'status_demandes.lib',
				'u.prenom',
				'u.nom',
				'demande_infos.status_id',
				'demande_infos.observation',
			)
			->get();
		$demandeCons = DemandeConsultation::select(
			'demande_consultation.id',
			'status_demandes.lib as status',
			'demande_consultation.coordinateur_en_charge',
			DB::raw("concat(users.prenom,' ',users.nom) as coordinateurEnCharge"),
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'demande_consultation.status_id',
			'demande_consultation.dossier_id',
			'demande_consultation.objet',
			'demande_consultation.observation'
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_consultation.status_id')
			->leftJoin('users', 'users.id', '=', 'demande_consultation.coordinateur_en_charge')
			->leftJoin('users as u', 'u.id', '=', 'demande_consultation.created_by')
			->where('demande_consultation.id', '=', $id)
			->first();
		$dossier = Dossier::find($demandeCons->dossier_id)->first();
		return view('coordinateurChef.demandeCons.liste_demande_infos', [
			'dossier' => $dossier,
			'demandeCons' => $demandeCons,
			'demandes' => $demandes
		]);
	}

	public function demande_infos($id)
	{
		$demandeInfos = DemandeInfos::select(
			'demande_infos.id',
			'status_demandes.lib as status',
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'demande_infos.status_id',
			'demande_infos.observation',
			DB::raw("count(demande_infos_files.downloads) as downloads"),
			'demande_infos.demande_cons_id'
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_infos.status_id')
			->leftJoin('users as u', 'u.id', '=', 'demande_infos.created_by')
			->leftJoin('demande_infos_files', 'demande_infos_files.idDemandeInfos', '=', 'demande_infos.id')
			->where('demande_infos.id', '=', $id)
			->groupBy(
				'demande_infos.id',
				'status_demandes.lib',
				'u.prenom',
				'u.nom',
				'demande_infos.status_id',
				'demande_infos.observation',
				'demande_infos.demande_cons_id'
			)
			->first();
		$files = DemandeInfosFiles::where('idDemandeInfos', '=', $demandeInfos->id)
			->get();

		$repDemandeInfos = RepDemandeInfos::select(
			'rep_demande_infos.id',
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'rep_demande_infos.observation',
			DB::raw("count(rep_demande_infos_files.downloads) as downloads"),
			'rep_demande_infos.demande_infos_id'
		)
			->leftJoin('users as u', 'u.id', '=', 'rep_demande_infos.created_by')
			->leftJoin('rep_demande_infos_files', 'rep_demande_infos_files.idRepDemandeInfos', '=', 'rep_demande_infos.id')
			->where('rep_demande_infos.demande_infos_id', '=', $id)
			->groupBy(
				'rep_demande_infos.id',
				'u.prenom',
				'u.nom',
				'rep_demande_infos.observation',
				'rep_demande_infos.demande_infos_id'
			)
			->get();
		if ($repDemandeInfos->isEmpty()) {
			$var = 0;
		} else {
			$var = $repDemandeInfos[0]->id;
		}
		$repFiles = RepDemandeInfosFiles::where('idRepDemandeInfos', '=', $var)
			->get();
		$demandeCons = DemandeConsultation::select(
			'demande_consultation.id',
			'status_demandes.lib as status',
			'demande_consultation.coordinateur_en_charge',
			DB::raw("concat(users.prenom,' ',users.nom) as coordinateurEnCharge"),
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'demande_consultation.status_id',
			'demande_consultation.dossier_id',
			'demande_consultation.objet',
			'demande_consultation.observation'
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_consultation.status_id')
			->leftJoin('users', 'users.id', '=', 'demande_consultation.coordinateur_en_charge')
			->leftJoin('users as u', 'u.id', '=', 'demande_consultation.created_by')
			->where('demande_consultation.id', '=', $demandeInfos->demande_cons_id)
			->first();
		$var = DemandeConsultation::find($demandeInfos->demande_cons_id)->coordinateur_en_charge;
		if ($var !== auth::user()->id) {
			abort(403, 'Unauthorized action.');
		}
		$dossier = Dossier::find($demandeCons->dossier_id)->first();
		return view('coordinateurChef.demandeCons.demande_infos', [
			'dossier' => $dossier,
			'demandeCons' => $demandeCons,
			'demandeInfos' => $demandeInfos,
			'repDemandeInfos' => $repDemandeInfos,
			'files' => $files,
			'repFiles' => $repFiles,
		]);
	}

	public function consulter($id, $notif)
	{
		$notification = Notification::find($notif)->update(['read_at' => now()]);

		$demandeInfos = DemandeInfos::select(
			'demande_infos.id',
			'status_demandes.lib as status',
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'demande_infos.status_id',
			'demande_infos.observation',
			DB::raw("count(demande_infos_files.downloads) as downloads"),
			'demande_infos.demande_cons_id'
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_infos.status_id')
			->leftJoin('users as u', 'u.id', '=', 'demande_infos.created_by')
			->leftJoin('demande_infos_files', 'demande_infos_files.idDemandeInfos', '=', 'demande_infos.id')
			->where('demande_infos.id', '=', $id)
			->groupBy(
				'demande_infos.id',
				'status_demandes.lib',
				'u.prenom',
				'u.nom',
				'demande_infos.status_id',
				'demande_infos.observation',
				'demande_infos.demande_cons_id'
			)
			->first();
		$files = DemandeInfosFiles::where('idDemandeInfos', '=', $demandeInfos->id)
			->get();

		$repDemandeInfos = RepDemandeInfos::select(
			'rep_demande_infos.id',
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'rep_demande_infos.observation',
			DB::raw("count(rep_demande_infos_files.downloads) as downloads"),
			'rep_demande_infos.demande_infos_id'
		)
			->leftJoin('users as u', 'u.id', '=', 'rep_demande_infos.created_by')
			->leftJoin('rep_demande_infos_files', 'rep_demande_infos_files.idRepDemandeInfos', '=', 'rep_demande_infos.id')
			->where('rep_demande_infos.demande_infos_id', '=', $id)
			->groupBy(
				'rep_demande_infos.id',
				'u.prenom',
				'u.nom',
				'rep_demande_infos.observation',
				'rep_demande_infos.demande_infos_id'
			)
			->get();
		if ($repDemandeInfos->isEmpty()) {
			$x = 0;
		} else {
			$x = $repDemandeInfos[0]->id;
		}
		$repFiles = RepDemandeInfosFiles::where('idRepDemandeInfos', '=', $x)
			->get();
		$demandeCons = DemandeConsultation::select(
			'demande_consultation.id',
			'status_demandes.lib as status',
			'demande_consultation.coordinateur_en_charge',
			DB::raw("concat(users.prenom,' ',users.nom) as coordinateurEnCharge"),
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'demande_consultation.status_id',
			'demande_consultation.dossier_id',
			'demande_consultation.objet',
			'demande_consultation.observation'
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_consultation.status_id')
			->leftJoin('users', 'users.id', '=', 'demande_consultation.coordinateur_en_charge')
			->leftJoin('users as u', 'u.id', '=', 'demande_consultation.created_by')
			->where('demande_consultation.id', '=', $demandeInfos->demande_cons_id)
			->first();
		$var = DemandeConsultation::find($demandeInfos->demande_cons_id)->coordinateur_en_charge;
		if ($var !== auth::user()->id) {
			abort(403, 'Unauthorized action.');
		}
		$dossier = Dossier::find($demandeCons->dossier_id)->first();
		return view('coordinateurChef.demandeCons.demande_infos', [
			'dossier' => $dossier,
			'demandeCons' => $demandeCons,
			'demandeInfos' => $demandeInfos,
			'repDemandeInfos' => $repDemandeInfos,
			'files' => $files,
			'repFiles' => $repFiles,
		]);
	}

	public function demande($id)
	{
		$demande_consultation = DemandeConsultation::select(
			'demande_consultation.id',
			'demande_consultation.status_id',
			'status_demandes.lib as status',
			'demande_consultation.coordinateur_en_charge',
			DB::raw("concat(users.prenom,' ',users.nom) as coordinateurEnCharge"),
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'demande_consultation.dossier_id',
			'demande_consultation.observation',
			'demande_consultation.objet',
			'types_demandes.lib as type_demande'
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_consultation.status_id')
			->leftJoin('users', 'users.id', '=', 'demande_consultation.coordinateur_en_charge')
			->leftJoin('users as u', 'u.id', '=', 'demande_consultation.created_by')
			->leftJoin('types_demandes', 'types_demandes.id', '=', 'demande_consultation.type_demande_id')
			->where('demande_consultation.id', '=', $id)
			->first();
		$demandes_devis = DemandeDevis::select(
			'demande_devis.id',
			'demande_devis.status_id',
			'status_demandes.lib as status',
			'demande_devis.objet',
			'demande_devis.type_demande_id',
			'types_demandes.lib as type_demande',
			'demande_devis.created_by',
			'users.nom',
			'users.prenom',
			'demande_devis.observation',
			'demande_devis.demande_cons_id',
			'demande_devis.created_at'
		)
			->leftJoin('types_demandes', 'demande_devis.type_demande_id', '=', 'types_demandes.id')
			->leftJoin('status_demandes', 'demande_devis.status_id', '=', 'status_demandes.id')
			->leftJoin('users', 'demande_devis.Created_by', '=', 'users.id')
			->where('demande_devis.demande_cons_id', '=', $demande_consultation->id)
			->get();
		$dossier = Dossier::findorfail($demande_consultation->dossier_id);
		$coordinateurs = User::where('role_id', '=', 5)->get();
		return view('coordinateurChef.demandeCons.demande', [
			'dossier' => $dossier,
			'demande_consultation' => $demande_consultation,
			'demandes_devis' => $demandes_devis,
			'coordinateurs' => $coordinateurs
		]);
	}

	public function affecter($id)
	{
		$var = DemandeConsultation::find($id)->coordinateur_en_charge;
		if ($var !== auth::user()->id) {
			abort(403, 'Unauthorized action.');
		}
		$demandeCons = DemandeConsultation::select(
			'demande_consultation.id',
			'demande_consultation.coordinateur_en_charge',
			DB::raw("concat(users.prenom,' ',users.nom) as coordinateurEnCharge"),
			'demande_consultation.dossier_id',
		)
			->leftJoin('users', 'users.id', '=', 'demande_consultation.coordinateur_en_charge')
			->where('demande_consultation.id', '=', $id)
			->first();
		$dossier = Dossier::find($demandeCons->dossier_id);
		$coordinateurs = User::where('role_id', '=', 4)
			->orWhere('role_id', '=', 5)
			->get();
		return view('coordinateurChef.demandeCons.affecter', [
			'coordinateurs' => $coordinateurs,
			'demandeCons' => $demandeCons,
			'dossier' => $dossier
		]);
	}

	public function affecter_chef($id)
	{
		$dossier_id = DemandeConsultation::find($id)->dossier_id;
		$var = DossierCoordinateur::where('dossier_id', '=', $dossier_id)
			->where('user_id', '=', auth::user()->id)->first();
		if ($var === null) {
			abort(403, 'Unauthorized action.');
		}
		$demandeCons = DemandeConsultation::select(
			'demande_consultation.id',
			'demande_consultation.coordinateur_en_charge',
			DB::raw("concat(users.prenom,' ',users.nom) as coordinateurEnCharge"),
			'demande_consultation.dossier_id',
		)
			->leftJoin('users', 'users.id', '=', 'demande_consultation.coordinateur_en_charge')
			->where('demande_consultation.id', '=', $id)
			->first();
		$dossier = Dossier::find($demandeCons->dossier_id);
		/*$coordinateurs = User::where('role_id', '=', 4)
			->orWhere('role_id', '=', 5)
			->get();*/
		$coordinateurs = User::Where('role_id', '=', 4)
			->orwhereIn(
				'users.id',
				CoordinateurCoordinateurChef::select('coordinateur_coordinateur_chef.coordinateur_id')->where('coordinateurChef_id', '=', auth::user()->id)->get()
			)
			->get();
		return view('coordinateurChef.demandeCons.affecter', [
			'coordinateurs' => $coordinateurs,
			'demandeCons' => $demandeCons,
			'dossier' => $dossier
		]);
	}
	public function save(Request $request)
	{
		$aff = new AffectationDemandeConsultation();
		$aff->demandeCons_id = $request->input('demande_cons_id');
		$aff->coordinateur_id = $request->input('coordinateur_id');
		$aff->date_debut = \Carbon\Carbon::now();
		$aff->actif = true;
		$aff->created_by = Auth::user()->id;
		$aff->save();
		$demandeCons = DemandeConsultation::find($request->input('demande_cons_id'));
		$demandeCons->update(['coordinateur_en_charge' => $aff->coordinateur_id]);
		$user = User::find($demandeCons->created_by);
		$coord = User::find($demandeCons->coordinateur_en_charge);
		$affected_by = User::find(auth::user()->id);
		$data = [
			'user' => $user->prenom . ' ' . $user->nom,
			'coord' => $coord->prenom . ' ' . $coord->nom,
			'demande' => $demandeCons->id,
			'affected_by' => $affected_by->prenom . ' ' . $affected_by->nom
		];
		$user->notify(new \App\Notifications\AffectationDemandeConsNotification($data));
		$coord->notify(new \App\Notifications\CoordAffectationDemandeConsNotification($data));
		return redirect('coordinateurChef/demandeCons/demande/' . $demandeCons->id);
	}

	public function demandeDevis($id)
	{
		$var = DemandeConsultation::find($id)->coordinateur_en_charge;
		if ($var !== auth::user()->id) {
			abort(403, 'Unauthorized action.');
		}
		$demande = DemandeConsultation::find($id);
		return view('coordinateurChef.demandeCons' . $id . '.demande-devis', ['demande' => $demande]);
	}

	/* public function désactiver($id)
	{
		$aff = AffectationDemandeConsultation::findorfail($id);
		$aff->date_fin = \Carbon\Carbon::now();
		$aff->actif = false;
		$aff->deactivated_by = Auth::user()->id;
		$aff->deactivated_at = \Carbon\Carbon::now();
		$aff->save();
		return Redirect::back();
	} */

	public function cloturer($id)
	{
		DemandeConsultation::findOrFail($id)
			->update([
				'status_id' => 4,
				'closed_by' => Auth::user()->id,
				'closed_at' => now(),
			]);
		return Redirect::back();
	}

	public function enAttenteInfos($id)
	{
		$var = DemandeConsultation::find($id)->coordinateur_en_charge;
		if ($var !== auth::user()->id) {
			abort(403, 'Unauthorized action.');
		}
		$demande = DemandeConsultation::find($id);
		$dossier = Dossier::findorfail($demande->dossier_id);
		return view('coordinateurChef/demandeCons/enAttenteInfos', [
			'dossier' => $dossier,
			'demande' => $demande,
		]);
	}

	public function storeDemandeInfos(Request $request)
	{
		$demande = new DemandeInfos();
		$demande->status_id = 1;
		$demande->demande_cons_id = $request->input('demande_cons_id');
		$demande->observation = $request->input('observation');
		$demande->created_by = auth::user()->id;
		$demande->save();
		$d = DemandeConsultation::find($demande->demande_cons_id);
		$d->update(['status_id' => 3]);
		if ($files = $request->file('filesup')) {
			foreach ($files as $img) {
				$img->move('uploads/demandeInfos/', $demande->demande_cons_id . "-" . time() . "-" . $img->getClientOriginalName());
				$photo = new DemandeInfosFiles;
				$photo->idDemandeInfos = $demande->id;
				$photo->downloads = $demande->demande_cons_id . "-" . time() . "-" . $img->getClientOriginalName();
				$photo->save();
			}
		}
		$user = User::find($d->created_by);
		$data = [
			'user' => $user->prenom . ' ' . $user->nom,
			'demande' => $demande->id,
		];
		$user->notify(new \App\Notifications\DemandeInfosNotification($data));
		return redirect('coordinateurChef/demandeCons/' . $d->dossier_id . '/show');
	}

	public function prendreEnCharge($notif, $id)
	{
		$d = DemandeConsultation::find($id);
		$d->update(['coordinateur_en_charge' => auth::user()->id, 'status_id' => 6]);
		$user = User::find(auth::user()->id);
		$data = [
			'user' => $user->prenom . ' ' . $user->nom,
			'demande' => $d->id,
		];
		User::find($d->created_by)->notify(new \App\Notifications\PriseenchargeDemandeConsNotification($data));

		$a = DossierCoordinateur::where('user_id', '=', auth::user()->id)->where('dossier_id', '=', $d->dossier_id)->first();
		if ($a === null) {
			$p = new DossierCoordinateur();
			$p->dossier_id = $d->dossier_id;
			$p->user_id = auth::user()->id;
			$p->save();
		}
		Notification::find($notif)->update(['read_at' => now()]);
		return back();
	}

	public function prendreEnCharge1($id)
	{
		$d = DemandeConsultation::find($id);
		$d->update(['coordinateur_en_charge' => auth::user()->id, 'status_id' => 6]);
		$user = User::find(auth::user()->id);
		$data = [
			'user' => $user->prenom . ' ' . $user->nom,
			'demande' => $d->id,
		];
		User::find($d->created_by)->notify(new \App\Notifications\PriseenchargeDemandeConsNotification($data));

		$a = DossierCoordinateur::where('user_id', '=', auth::user()->id)->where('dossier_id', '=', $d->dossier_id)->first();
		if ($a === null) {
			$p = new DossierCoordinateur();
			$p->dossier_id = $d->dossier_id;
			$p->user_id = auth::user()->id;
			$p->save();
		}
		return back();
	}

	public function enAttente()
	{
		$demandes = DemandeConsultation::select(
			'demande_consultation.id',
			'status_id',
			'status_demandes.lib as status',
			'demande_consultation.coordinateur_en_charge',
			'demande_consultation.dossier_id',
			DB::raw("concat(users.prenom,' ',users.nom) as coordinateurEnCharge"),
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'demande_consultation.created_at',
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_consultation.status_id')
			->leftJoin('users', 'users.id', '=', 'demande_consultation.coordinateur_en_charge')
			->leftJoin('users as u', 'u.id', '=', 'demande_consultation.created_by')
			->whereNull('demande_consultation.coordinateur_en_charge')

			->get();
		return view('coordinateurChef.demandeCons.enAttente', [
			'demandes' => $demandes
		]);
	}

	public function monequipe()
	{
		$demandes = DemandeConsultation::select(
			'demande_consultation.id',
			'status_id',
			'status_demandes.lib as status',
			'demande_consultation.coordinateur_en_charge',
			'demande_consultation.dossier_id',
			DB::raw("concat(users.prenom,' ',users.nom) as coordinateurEnCharge"),
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'demande_consultation.created_at',
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_consultation.status_id')
			->leftJoin('users', 'users.id', '=', 'demande_consultation.coordinateur_en_charge')
			->leftJoin('users as u', 'u.id', '=', 'demande_consultation.created_by')
			->whereIn(
				'demande_consultation.coordinateur_en_charge',
				CoordinateurCoordinateurChef::select('coordinateur_coordinateur_chef.coordinateur_id')->where('coordinateurChef_id', '=', auth::user()->id)->get()
			)
			->get();
		/*$d=CoordinateurCoordinateurChef::select('coordinateur_coordinateur_chef.coordinateur_id')->where('coordinateurChef_id','=',auth::user()->id)->get();
			dd($d);*/
		return view('coordinateurChef.demandeCons.monequipe', [
			'demandes' => $demandes
		]);
	}
	public function coordinateur()
	{
		$coordinateurs = CoordinateurCoordinateurChef::select(
			'users.id',
			'users.nom',
			'users.prenom',
			'coordinateur_coordinateur_chef.actif',
			'coordinateur_coordinateur_chef.id as coord'
		)
			->leftJoin('users', 'coordinateur_coordinateur_chef.coordinateur_id', '=', 'users.id')
			->where('coordinateur_coordinateur_chef.coordinateurChef_id', '=', auth::user()->id)
			->get();

		return response()->json([
			'data' => $coordinateurs
		]);
	}

	public function store(Request $request)
	{
		$demande = new DemandeConsultation();
		$demande->dossier_id = $request->input('dossier_id');
		$demande->status_id = 1;
		$demande->type_demande_id = $request->input('type_demande_id');
		$demande->objet = $request->input('objet');
		$demande->observation = $request->input('observation');
		$demande->coordinateur_en_charge = $request->input('coordinateur_en_charge');
		$demande->created_by = auth::user()->id;
		$demande->save();
		$coordinateurs = User::select('users.id', 'users.nom', 'users.prenom')
			->leftJoin('representant_Coordinateur', 'users.id', '=', 'coordinateur_id')
			->where('representant_Coordinateur.representant_id', '=', auth::user()->id)
			->wherenull('representant_coordinateur.deleted_at')
			->get();
		foreach ($coordinateurs as $coordinateur) {
			$coordinateur->notify(new \App\Notifications\NewDemandeConsNotification($demande));
		}
		if ($files = $request->file('filesup')) {
			foreach ($files as $img) {
				$img->move('uploads/demandeCons/', $demande->dossier_id . "-" . time() . "-" . $img->getClientOriginalName());
				$photo = new DemandeConsFiles;
				$photo->idDemandeCons = $demande->id;
				$photo->downloads = $demande->dossier_id . "-" . time() . "-" . $img->getClientOriginalName();
				$photo->save();
			}
		}
		if ($request->input('coordinateur_en_charge') !== null) {
			$acces = new DossierCoordinateur();
			$acces->user_id = $request->input('coordinateur_en_charge');
			$acces->dossier_id = $request->input('dossier_id');
			$acces->save();
		}

		return redirect('coordinateurChef/demandeCons/demande/' . $demande->id);
	}
}
