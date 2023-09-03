<?php

namespace App\Http\Controllers\coordinateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Dossier;
use App\Models\DemandeConsultation;
use App\Models\AffectationDemandeConsultation;
use App\Models\CoordinateurCoordinateurChef;
use App\Models\User;
use App\Models\Notification;
use App\Models\DemandeDevis;
use App\Models\DemandeInfos;
use App\Models\DemandeInfosFile;
use App\Models\DemandeInfosFiles;
use App\Models\DossierUser;
use App\Models\DossierAccessHistory;
use App\Models\RepDemandeInfos;
use App\Models\RepDemandeInfosFiles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class demandeConsController extends Controller
{
	public function index()
	{
		$dossiers = Dossier::with('dossierUsers', 'demandesConsultations')
			->whereHas('dossierUsers', function ($query) {
				$query->where('user_id', Auth::user()->id);
			})
			->get();
		return view('coordinateur.demandeCons.index', compact('dossiers'));
	}

	public function show($id_dossier)
	{
		$dossier = Dossier::findorfail($id_dossier);
		$demandes = DemandeConsultation::where('dossier_id', $id_dossier)
			->where(function ($query) {
				$query->whereNull('coordinateur_en_charge')
					->orWhere('coordinateur_en_charge', Auth::user()->id);
			})
			->get();
		return view('coordinateur.demandeCons.show', compact('dossier', 'demandes'));
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
		return view('coordinateur.demandeCons.liste_demande_infos', [
			'dossier' => $dossier,
			'demandeCons' => $demandeCons,
			'demandes' => $demandes
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
		return view('coordinateur.demandeCons.demande_infos', [
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
		$demande = DemandeConsultation::findOrFail($id);

		$demandes_devis = DemandeDevis::where('demande_cons_id', $demande->id);

		$demandeInfos = $demande->demandeInfos()->first();
		$repDemandeInfos = null;
		if ($demandeInfos) {
			$repDemandeInfos = $demandeInfos->repInfos;
		}
		$dossier = $demande->dossier;
		$coordinateurs = User::whereIn('role_id', [4, 6])->get();

		return view('coordinateur.demandeCons.demande', compact('dossier', 'demande', 'demandes_devis', 'coordinateurs', 'demandeInfos', 'repDemandeInfos'));
	}

	public function affecter($id)
	{
		$var = DemandeConsultation::find($id)->coordinateur_en_charge;
		if ($var !== auth::user()->id) {
			abort(403, 'Unauthorized action.');
		}
		$demandeCons = DemandeConsultation::findorFail($id);
		$dossier = Dossier::find($demandeCons->dossier_id);
		$coordinateurs = User::whereIn('role_id', [4, 6])
			->Where('id', '!=', auth::user()->id)
			->Where('id', '!=', $demandeCons->coordinateur_en_charge)
			->get();
		return view('coordinateur.demandeCons.affecter', compact('coordinateurs', 'demandeCons', 'dossier'));
	}

	public function save(Request $request)
	{
		$aff = AffectationDemandeConsultation::create([
			'demandeCons_id' => $request->input('demande_cons_id'),
			'assigned_to' => $request->input('coordinateur_id'),
			'assigned_by' => Auth::user()->id,
		]);

		$demandeConsultation = DemandeConsultation::findorFail($request->input('demande_cons_id'));

		$demandeConsultation->update(['coordinateur_en_charge' => $aff->assigned_to]);

		DossierUser::firstorCreate([
			'dossier_id' => $demandeConsultation->dossier_id,
			'user_id' => $aff->assigned_to
		]);
		DossierAccessHistory::create([
			'dossier_id' => $demandeConsultation->dossier_id,
			'user_id' => $aff->assigned_to,
			'granted' => 1,
			'created_by' => Auth::user()->id
		]);

		$user = User::findorFail($demandeConsultation->created_by);
		$coordinateur = User::findorFail($demandeConsultation->coordinateur_en_charge);
		$old_coordinateur = User::findorFail(Auth::user()->id);
		$data = [
			'assigned_to' => $coordinateur->prenom . ' ' . $coordinateur->nom,
			'demande' => $demandeConsultation->id,
			'assigned_by' => $old_coordinateur->prenom . ' ' . $old_coordinateur->nom,
		];
		$user->notify(new \App\Notifications\AffectationDemandeConsNotification($data));
		$coordinateur->notify(new \App\Notifications\AffectationDemandeConsNotificationCoordinateur($data));
		return redirect('coordinateur/demandeCons/demande/' . $demandeConsultation->id);
	}

	public function demandeDevis($id)
	{
		dd('test');
		$var = DemandeConsultation::find($id)->coordinateur_en_charge;
		if ($var !== auth::user()->id) {
			abort(403, 'Unauthorized action.');
		}
		$demande = DemandeConsultation::find($id);
		return view('coordinateur.demandeCons' . $id . '.demande-devis', ['demande' => $demande]);
	}

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
		return view('coordinateur/demandeCons/enAttenteInfos', compact('dossier', 'demande'));
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
				$photo = new DemandeInfosFile();
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
		return redirect('coordinateur/demandeCons/' . $d->dossier_id . '/show');
	}

	public function prendreEnCharge($notif, $id)
	{
		dd('prendreencharge');
		$d = DemandeConsultation::findorFail($id);
		$d->update(['coordinateur_en_charge' => auth::user()->id, 'status_id' => 6]);
		$user = User::find(auth::user()->id);
		$data = [
			'user' => $user->prenom . ' ' . $user->nom,
			'demande' => $d->id,
		];
		User::find($d->created_by)->notify(new \App\Notifications\PriseenchargeDemandeConsNotification($data));

		$a = DossierUser::where('user_id',  auth::user()->id)->where('dossier_id',  $d->dossier_id)->first();
		if ($a === null) {
			$p = new DossierUser();
			$p->dossier_id = $d->dossier_id;
			$p->user_id = auth::user()->id;
			$p->save();
		}
		Notification::find($notif)->update(['read_at' => now()]);
		return back();
	}

	public function prendreEnCharge1($id)
	{
		$demande = DemandeConsultation::findOrFail($id);
		$user = auth()->user();
		$demande->update([
			'coordinateur_en_charge' => $user->id,
			'status_id' => 6
		]);
		$data = [
			'user' => $user->prenom . ' ' . $user->nom,
			'demande' => $demande->id,
		];
		User::findOrFail($demande->created_by)->notify(new \App\Notifications\PriseenchargeDemandeConsNotification($data));

		DossierUser::firstOrCreate([
			'dossier_id' => $demande->dossier_id,
			'user_id' => $user->id,
		]);
		return back();
	}

	public function enAttente()
	{
		dd('en attente');
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
			->where('demande_consultation.created_at', '<=', Carbon::yesterday()->toDateString())
			->get();

		return view('coordinateur.demandeCons.enAttente', [
			'demandes' => $demandes
		]);
	}

	public function coordinateur()
	{
		dd('coordinateur');
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

		return response()->json(['data' => $coordinateurs]);
	}
}
