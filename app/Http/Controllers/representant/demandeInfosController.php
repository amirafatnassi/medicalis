<?php

namespace App\Http\Controllers\representant;

use App\Http\Controllers\Controller;
use App\Models\DemandeConsultation;
use App\Models\Dossier;
use App\Models\RepDemandeInfosFiles;
use App\Models\RepDemandeInfos;
use App\Models\DemandeInfos;
use App\Models\DemandeInfosFiles;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class demandeInfosController extends Controller
{
	public function repDemandeInfos($id)
	{
		$x = DemandeInfos::find($id);
		$x->status_id = 7;
		$x->read_at = now();
		$x->save();

		$demandeInfos =  DemandeInfos::select(
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

		$dossier = Dossier::find($demandeCons->dossier_id);

		return view('representant.demandeCons.demande_infos', [
			'demandeInfos' => $demandeInfos,
			'demandeCons' => $demandeCons,
			'dossier' => $dossier,
			'files' => $files
		]);
	}

	public function storeRep(Request $request)
	{
		$repDemande = new RepDemandeInfos();
		$repDemande->observation = $request->input('observation');
		$repDemande->demande_infos_id = $request->input('demande_infos_id');
		$repDemande->created_by = auth::user()->id;
		$repDemande->save();

		$var = DemandeInfos::find($request->input('demande_infos_id'));
		$var->update(['status_id' => 8]);
		DemandeConsultation::find($var->demande_cons_id)->update(['status_id' => 9]);
		$user = User::find($var->created_by);
		$data = [
			'user' => $user->prenom . ' ' . $user->nom,
			'demande_infos' => $var->id,
			'rep_demande_infos' => $repDemande->id
		];
		$user->notify(new \App\Notifications\RepDemandeInfosNotification($data));

		if ($files = $request->file('filesup')) {
			foreach ($files as $img) {
				$img->move('uploads/repDemandeInfos/', $repDemande->id . "-" . time() . "-" . $img->getClientOriginalName());
				$photo = new RepDemandeInfosFiles;
				$photo->idRepDemandeInfos = $repDemande->id;
				$photo->downloads = $repDemande->id . "-" . time() . "-" . $img->getClientOriginalName();
				$photo->save();
			}
		}
		return redirect('representant/demandeCons/index');
	}
}
