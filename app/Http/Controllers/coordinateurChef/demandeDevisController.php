<?php

namespace App\Http\Controllers\coordinateurChef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\DemandeDevis;
use App\Models\Medecin;
use App\Models\DemandeConsultation;
use App\Models\DemandeDevisFiles;
use App\Models\Temp;
use App\Models\User;
use App\Models\TypeDemande;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class demandeDevisController extends Controller
{

	public function demandeDevis($id)
	{
		$types = TypeDemande::all();
		$demande = DemandeConsultation::where('demande_consultation.id', '=', $id)->first();
		$dossier = Dossier::find($demande->dossier_id);
		return view('coordinateurChef.demandeCons.demande-devis', [
			'demande' => $demande,
			'dossier' => $dossier,
			'types' => $types
		]);
	}


	public function destinataires($id)
	{
		$devis = DemandeDevis::find($id);
		$demande = DemandeConsultation::where('demande_consultation.id', '=', $devis->demande_cons_id)->first();
		$dossier = Dossier::find($demande->dossier_id);
		$temps = Temp::select(
			'temp.id_medecin',
			DB::Raw("concat(prenom,' ',nom) as display_name"),
		)->leftJoin('medecins', 'temp.id_medecin', '=', 'medecins.id')
			->where('id_demande_devis', '=', $id)
			->get();

		$medecins = User::select(
			'users.id',
			'users.role_id',
			DB::Raw("concat(prenom,' ',nom) as display_name"),
		)->where('users.role_id', '=', 2)
			->whereNotIn('id', DB::table('temp')
				->where('id_demande_devis', '=', $id)
				->pluck('id_medecin'))
			->paginate(5);

		return view('coordinateurChef.demandeCons.destinataires', [
			'demande_devis' => $id,
			'demande' => $demande,
			'dossier' => $dossier,
			'medecins' => $medecins,
			'temps' => $temps,
		]);
	}


	public function resume($id)
	{
		$devis = DemandeDevis::select(
			'demande_devis.id',
			'demande_devis.status_id',
			'status_demandes.lib as status',
			'demande_devis.type_demande_id',
			'types_demandes.lib as type_demande',
			'demande_devis.objet',
			'demande_devis.observation',
			'demande_devis.demande_cons_id',
			'demande_devis.created_at',
			DB::raw("concat(users.prenom,' ',users.nom) as utilisateur")
		)
			->leftJoin('status_demandes', 'demande_devis.status_id', '=', 'status_demandes.id')
			->leftJoin('types_demandes', 'demande_devis.type_demande_id', '=', 'types_demandes.id')
			->leftJoin('users', 'users.id', '=', 'demande_devis.created_by')
			->where('demande_devis.id', '=', $id)->first();
		$demande = DemandeConsultation::where('demande_consultation.id', '=', $devis->demande_cons_id)->first();
		$dossier = Dossier::find($demande->dossier_id);
		$destinataires = Temp::select(
			'temp.id_medecin',
			DB::Raw("concat(prenom,' ',nom) as display_name"),
		)
			->leftJoin('medecins', 'temp.id_medecin', '=', 'medecins.id')
			->where('id_demande_devis', '=', $id)
			->get();

		$files = DemandeDevisFiles::where('idDemandeDevis', '=', $devis->id)->get();
		return view('coordinateurChef.demandeCons.resume', [
			'devis' => $devis,
			'demande' => $demande,
			'dossier' => $dossier,
			'destinataires' => $destinataires,
			'files' => $files
		]);
	}

	public function ajouterDestinataire($id, $demande)
	{
		$med = User::find($id);
		if (Temp::where('id_medecin', '=', $id)->count() === 0) {
			$temp = new Temp();
			$temp->id_medecin = $med->id;
			$temp->id_demande_devis = $demande;
			$temp->save();
		}
		return Redirect::back();
	}

	public function supprimerDestinataire($id)
	{
		Temp::where('id_medecin', '=', $id)->delete();
		return Redirect::back();
	}

	public function store(Request $request)
	{
		$devis = new DemandeDevis();
		$devis->status_id = 1;
		$devis->type_demande_id =  $request->input('type_demande_id');;
		$devis->objet = $request->input('objet');
		$devis->observation =  $request->input('observation');
		$devis->demande_cons_id =  $request->input('demande_cons_id');
		$devis->created_by = Auth::user()->id;
		$devis->save();
		if ($files = $request->file('filesup')) {
			foreach ($files as $img) {
				$img->move('uploads/demandeDevis/', $devis->id . "-" . time() . "-" . $img->getClientOriginalName());
				$photo = new DemandeDevisFiles();
				$photo->idDemandeDevis = $devis->id;
				$photo->downloads = $devis->id . "-" . time() . "-" . $img->getClientOriginalName();
				$photo->save();
			}
		}
		return redirect('coordinateurChef/demandeDevis/' . $devis->id . '/destinataires');
	}

	public function show($id)
	{
		$demande_devis = DemandeDevis::select(
			'demande_devis.id',
			'status_demandes.lib as status',
			'demande_devis.type_demande_id',
			DB::raw("concat(users.prenom,' ',users.nom) as user"),
			'demande_devis.status_id',
			'demande_devis.objet',
			'demande_devis.observation',
			'demande_devis.demande_cons_id',
			'types_demandes.lib as type_demande'
		)
			->leftJoin('status_demandes', 'status_demandes.id', '=', 'demande_devis.status_id')
			->leftJoin('users', 'users.id', '=', 'demande_devis.created_by')
			->leftJoin('types_demandes', 'types_demandes.id', '=', 'demande_devis.type_demande_id')
			->where('demande_devis.id', '=', $id)
			->first();
		$demande_cons = DemandeConsultation::find($demande_devis->demande_cons_id);
		$dossier = Dossier::findorfail($demande_cons->dossier_id);

		return view('coordinateurChef.demandeCons.show_demande_devis', [
			'dossier' => $dossier,
			'demande_devis' => $demande_devis
		]);
	}

	public function storeDemandeDevis($id)
	{
		$d = DemandeDevis::find($id);
		$users =  Temp::select('id_medecin')
			->leftJoin('users', 'users.id', '=', 'temp.id_medecin')
			->where('temp.id_demande_devis', '=', $id)
			->get();
		DemandeConsultation::where('id', '=', $d->demande_cons_id)->update(['status_id' => 2]);
		$utilisateur = User::find(auth::user()->id);
		$data = [
			'id' => $id,
			'user' => $utilisateur->prenom . ' ' . $utilisateur->nom,
			'objet' => $d->objet,
			'observation' => $d->observation
		];
		dd($users);
		foreach ($users as $u) {
			$user = User::find($u->id_medecin);
			dd($user);
			$user->notify(new \App\Notifications\NewDemandeDevisNotification($data));
		}
		dd('rr');
		Temp::where('id_demande_devis', '=', $id)->delete();

		return redirect('coordinateurChef/demandeCons/demande/' . $d->demande_cons_id);
	}

	public function annulerDemandeDevis($id)
	{
		$d = DemandeDevis::find($id);
		Temp::where('id_demande_devis', '=', $id)->delete();
		DemandeDevis::where('id', '=', $id)->delete();
		return redirect('coordinateurChef/demandeCons/demande' . $d->demande_cons_id);
	}
}
