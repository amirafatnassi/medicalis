<?php

namespace App\Http\Controllers\representant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Dossier;
use App\Models\DemandeConsultation;
use App\Models\AffectationDemandeConsultation;
use App\Models\User;
use App\Models\DemandeConsFiles;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class demandeConsController extends Controller
{
	public function index()
	{
		$dossiers = Dossier::select(
			'dossiers.id',
			'nom',
			'prenom',
			'image',
			'c.lib as convention',
			DB::raw("count(demande_consultation.id) as nb_demandes")
		)
			->leftJoin('dossier_users as u', 'dossiers.id', '=', 'u.dossier_id')
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
			)
			->get();
		return view('representant.demandeCons.index', [
			'dossiers' => $dossiers,
		]);
	}

	public function create($id_dossier)
	{
		$users = User::all();
		$dossier = Dossier::findorfail($id_dossier);
		return view('representant.demandeCons.create', [
			'dossier' => $dossier,
			'users' => $users,
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
		return redirect('representant/demandeCons/index');
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
			'demande_consultation.created_by',
			'demande_consultation.status_id'
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_consultation.status_id')
			->leftJoin('users', 'users.id', '=', 'demande_consultation.coordinateur_en_charge')
			->leftJoin('users as u', 'u.id', '=', 'demande_consultation.created_by')
			->where('demande_consultation.dossier_id', '=', $id_dossier)
			->get();
		return view('representant.demandeCons.show', [
			'dossier' => $dossier,
			'demandes' => $demandes
		]);
	}

	public function demande($id)
	{
		$files = DemandeConsFiles::select('demande_cons_files.*')
			->where('idDemandeCons', '=', $id)->get();

		$demande_cons = DemandeConsultation::select(
			'demande_consultation.id',
			DB::raw("count(demande_cons_files.downloads) as downloads"),
			'demande_consultation.objet',
			'demande_consultation.status_id',
			'status_demandes.lib as status',
			'demande_consultation.coordinateur_en_charge',
			DB::raw("concat(users.prenom,' ',users.nom) as coordinateurEnCharge"),
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'demande_consultation.dossier_id',
			'demande_consultation.observation',
            DB::raw("CONCAT(u.prenom,' ',u.nom) AS user"),
            'demande_consultation.created_by',
            'demande_consultation.created_at',
            'demande_consultation.updated_at'
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_consultation.status_id')
			->leftJoin('users', 'users.id', '=', 'demande_consultation.coordinateur_en_charge')
			->leftJoin('users as u', 'u.id', '=', 'demande_consultation.created_by')
			->leftJoin('affectation_demandes_consultations', 'affectation_demandes_consultations.demandeCons_id', '=', 'demande_consultation.id')
			->leftJoin('demande_cons_files', 'demande_cons_files.idDemandeCons', '=', 'demande_consultation.id')
			->where('demande_consultation.id', '=', $id)
			->groupBy(
				'demande_consultation.id',
				'demande_consultation.status_id',
				'demande_consultation.objet',
				'status_demandes.lib',
				'demande_consultation.coordinateur_en_charge',
				'users.prenom',
				'users.nom',
				'u.prenom',
				'u.nom',
				'demande_consultation.dossier_id',
				'demande_consultation.observation',
				'demande_consultation.created_by',
				'demande_consultation.created_at',
				'demande_consultation.updated_at'
			)
			->first();
		$invoice = Invoice::where('invoices.demande_devis_id', '=', $id)->get();
		$dossier = Dossier::findorfail($demande_cons->dossier_id);
		return view('representant.demandeCons.demande', [
			'dossier' => $dossier,
			'demande' => $demande_cons,
			'files' => $files,
			'invoice' => $invoice
		]);
	}


	public function consulter($id)
	{
		$demande = DemandeConsultation::select(
			'demande_consultation.id',
			'demande_consultation.status_id',
			'status_demandes.lib as status',
			'demande_consultation.coordinateur_en_charge',
			DB::raw("concat(users.prenom,' ',users.nom) as coordinateurEnCharge"),
			DB::raw("concat(u.prenom,' ',u.nom) as user"),
			'demande_consultation.dossier_id',
			'demande_consultation.observation'
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_consultation.status_id')
			->leftJoin('users', 'users.id', '=', 'demande_consultation.coordinateur_en_charge')
			->leftJoin('users as u', 'u.id', '=', 'demande_consultation.created_by')
			->leftJoin('affectation_demandes_consultations', 'affectation_demandes_consultations.demandeCons_id', '=', 'demande_consultation.id')
			->where('demande_consultation.id', '=', $id)
			->first();

		$dossier = Dossier::findorfail($demande->dossier_id);
		//	$coordinateurs = User::where('role_id', '=', 5)->get();
		return view('representant.demandeCons.demande', [
			'dossier' => $dossier,
			'demande' => $demande,
			//	'coordinateurs' => $coordinateurs
		]);
	}

	public function affecter($id, Request $request)
	{
		$aff = new AffectationDemandeConsultation();
		$aff->demandeCons_id = $id;
		$aff->coordinateur_id = $request->coordinateur;
		$aff->date_debut = \Carbon\Carbon::now();
		$aff->actif = true;
		$aff->created_by = Auth::user()->id;
		$aff->save();
		return redirect('representant/demandeCons/demande/' . $id);
	}

	public function désactiver($id)
	{
		$aff = AffectationDemandeConsultation::findorfail($id);
		$aff->date_fin = \Carbon\Carbon::now();
		$aff->actif = false;
		$aff->deactivated_by = Auth::user()->id;
		$aff->deactivated_at = \Carbon\Carbon::now();
		$aff->save();
		return Redirect::back();
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

	public function attenteInfos($id)
	{
		return Redirect('representant/demandeCons/demande/enattenteInfod');
	}

	public function enAttenteInfos($id)
	{
		$demande = DemandeConsultation::find($id);
		$demande->status_id = 3;
		$demande->save();
		return Redirect::back();
	}
}
