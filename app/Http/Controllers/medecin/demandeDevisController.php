<?php

namespace App\Http\Controllers\medecin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\DemandeDevis;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class demandeDevisController extends Controller
{
	public function index()
	{
		$user = User::findorFail(Auth::user()->id);
		$demande_devis = $user->demandesDevis()->get();

		return view('medecin.demandeDevis.index', compact('demande_devis'));
	}

	public function consulter($id, $notif)
	{
		Notification::find($notif)->update(['read_at' => now()]);
		$demande_devis = DemandeDevis::findorFail($id);

		return view('medecin.demandeDevis.show', compact('demande_devis'));
	}

	public function show($id)
	{
		$connectedDestinataire = Auth::user();
		$demandeDevis = DemandeDevis::findorFail($id);


		// Check if the connected destinataire has issued an invoice for this demandedevis
		try {
			$invoice = $connectedDestinataire->invoices()
				->where('demande_devis_id', $id)
				->where('sender_id', $connectedDestinataire->id)
				->firstOrFail();
		} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			// Invoice not found
			$invoice = null; 
		}

		return view('medecin.demandeDevis.show', compact('demandeDevis', 'invoice'));
	}
}
