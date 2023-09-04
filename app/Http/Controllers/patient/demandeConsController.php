<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Dossier;
use App\Models\DemandeConsultation;
use App\Models\AffectationDemandeConsultation;
use App\Models\DemandeConsFiles;
use App\Models\User;
use App\Models\DemandeInfos;
use App\Models\GenInvoice;
use App\Models\RepDemandeInfos;
use Illuminate\Support\Facades\Auth;


class demandeConsController extends Controller
{
	public function create($id_dossier)
	{
		$users = User::all();
		$dossier = Dossier::findorfail($id_dossier);

		return view('patient.demandeCons.create', compact('dossier','users'));
	}

	public function store(Request $request)
	{
		$dossierId = $request->input('dossier_id');
		$demande = new DemandeConsultation();
		$demande->dossier_id = $dossierId;
		$demande->status_id = 1;
		$demande->type_demande_id = $request->input('type_demande_id');
		$demande->objet = $request->input('objet');
		$demande->observation = $request->input('observation');
		$demande->created_by = auth::user()->id;
		$demande->save();
		$coordinateurs = User::where('role_id', 4)
			->whereHas('dossierUsers', function ($query) use ($dossierId) {
				$query->where('dossier_id', $dossierId);
			})
			->get();
		foreach ($coordinateurs as $coordinateur) {
			$coordinateur->notify(new \App\Notifications\NewDemandeConsNotification($demande));
		}
		if ($files = $request->file('filesup')) {
			foreach ($files as $img) {
				$img->move('uploads/demandeCons/', $demande->dossier_id . "-" . time() . "-" . $img->getClientOriginalName());
				$photo = new DemandeConsFiles();
				$photo->idDemandeCons = $demande->id;
				$photo->downloads = $demande->dossier_id . "-" . time() . "-" . $img->getClientOriginalName();
				$photo->save();
			}
		}
		return redirect('patient/demandeCons/show');
	}

	public function show()
	{
		$dossier = dossier::where('user_id', Auth::user()->id)->first();

		$demandes = DemandeConsultation::with('status', 'coordinateurEnCharge', 'dossier', 'files', 'createdBy')
			->get();

		return view('patient.demandeCons.show', compact('dossier', 'demandes'));
	}

	public function demande($id)
	{
		$demandeCons = DemandeConsultation::findorFail($id);

		$demandeInfos =  DemandeInfos::where('demande_cons_id', $id)->first();

		$dossier = Dossier::findorfail($demandeCons->dossier_id);

		$repDemandeInfos = null;
		if ($demandeInfos) {
			$repDemandeInfos =  RepDemandeInfos::where('demande_infos_id', $demandeInfos->id)->first();
		}

		return view('patient.demandeCons.demande', compact('dossier', 'demandeCons', 'demandeInfos', 'repDemandeInfos',));
	}

	public function consulter($id)
	{
		$demande = DemandeConsultation::findorFail($id);
		$dossier = Dossier::findorfail($demande->dossier_id);

		return view('patient.demandeCons.demande', compact('dossier','demande'));
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
		return redirect('patient/demandeCons/demande/' . $id);
	}

	public function desactiver($id)
	{
		AffectationDemandeConsultation::findorfail($id)->update([
		'date_fin' => now(),
		'actif' => false,
		'deactivated_by' => Auth::user()->id,
		'deactivated_at' => now(),
		]);

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

	public function enAttenteInfos($id)
	{
		DemandeConsultation::findorFail($id)->update(['status_id' => 3]);

		return Redirect::back();
	}

	public function showDevis($id)
	{
		$invoice = GenInvoice::findorFail($id);

		return view('patient.demandeCons.show-invoice', compact('invoice'));
	}
}
