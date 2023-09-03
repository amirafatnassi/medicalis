<?php

namespace App\Http\Controllers\patient;

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
		$demandeInfos =  DemandeInfos::findorFail( $id);
		$x = $demandeInfos->update(['status_id' => 7, 'read_at' => now()]);
		
		$demandeCons = DemandeConsultation::findorFail($demandeInfos->demande_cons_id);

		$dossier = Dossier::findorFail($demandeCons->dossier_id);

		return view('patient.demandeCons.demande_infos', compact('demandeInfos' ,'demandeCons','dossier'));
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
		return redirect('patient/demandeCons/show');
	}
}
