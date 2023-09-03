<?php

namespace App\Http\Controllers\coordinateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\DemandeDevis;
use App\Models\Medecin;
use App\Models\DemandeConsultation;
use App\Models\DemandeDevisFiles;
use App\Models\Temp;
use App\Models\DestinataireDemandeDevis;
use App\Models\GenInvoice;
use App\Models\User;
use App\Models\Invoice;
use App\Models\InvoiceLine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class demandeDevisController extends Controller
{
	public function demandeDevis($id)
	{
		$demande = DemandeConsultation::findorFail($id);
		$dossier = Dossier::findorFail($demande->dossier_id);
		$meds = User::where('role_id', 3)->get();
		return view('coordinateur.demandeCons.demande-devis', compact('demande', 'dossier', 'meds'));
	}

	public function store(Request $request)
	{
		$demandeDevis = DemandeDevis::create([
			'status_id' => 1,
			'objet' => $request->input('objet'),
			'observation' =>  $request->input('observation'),
			'type_demande_id' =>  $request->input('type_demande_id'),
			'demande_cons_id' =>  $request->input('demande_cons_id'),
			'created_by' => Auth::user()->id
		]);

		$destinatairesIds = $request->input('destination_id');
		$demandeDevis->destinataires()->attach($destinatairesIds);

		if ($files = $request->file('filesup')) {
			foreach ($files as $img) {
				$img->move('uploads/demandeDevis/', $demandeDevis->id . "-" . time() . "-" . $img->getClientOriginalName());
				$photo = new DemandeDevisFiles();
				$photo->idDemandeDevis = $demandeDevis->id;
				$photo->downloads = $demandeDevis->id . "-" . time() . "-" . $img->getClientOriginalName();
				$photo->save();
			}
		}

		foreach ($destinatairesIds as $med) {
			$medecin = User::findorFail($med);
			$data = [
				'user' => $medecin->prenom . ' ' . $medecin->nom,
				'id' => $demandeDevis->id,
				'objet' => $demandeDevis->objet,
			];
			$medecin->notify(new \App\Notifications\NewDemandeDevisNotification($data));
		}

		DemandeConsultation::findorFail($demandeDevis->demande_cons_id)->update(['status_id' => 2]);
		return redirect('coordinateur/demandeCons/demande/' . $demandeDevis->demande_cons_id);
	}

	public function show($id)
	{
		$demande_devis = DemandeDevis::findorFail($id);
		$demande_cons = DemandeConsultation::find($demande_devis->demande_cons_id);
		$dossier = Dossier::findorfail($demande_cons->dossier_id);
		
		return view('coordinateur.demandeCons.show_demande_devis', compact('dossier','demande_devis',));
	}

	public function showInvoices($devis_id)
	{
		$invoices = Invoice::select(
			'invoices.id',
			'invoices.tva',
			'invoices.total_ht',
			'invoices.total_ttc',
			'invoices.currency',
			'invoices.demande_devis_id',
			'invoices.status',
			'status_invoices.lib as status_lib',
			'invoices.sender_id',
			DB::raw("concat(users.prenom,' ',users.nom) as sender"),
			'invoices.receiver_id',
			'invoices.note',
			'invoices.payment_info',
			'invoices.created_at',
			'invoices.date',
			'invoices.due_date'
		)
			->leftJoin('status_invoices', 'invoices.status', '=', 'status_invoices.id')
			->leftJoin('users', 'invoices.sender_id', '=', 'users.id')
			->where('invoices.demande_devis_id', '=', $devis_id)
			->get();
		$invoice_lines = InvoiceLine::select(
			'actes.lib as acte',
			'acte_details.lib as description',
			'quantity',
			'prix_unitaire',
			'discount',
			'Prix_ht',
			'Prix_ttc',
		)->leftJoin('actes', 'actes.id', '=', 'name')
			->leftJoin('acte_details', 'acte_details.id', '=', 'description')
			->get();
		$count = count($invoice_lines);
		$demande_devis = DemandeDevis::findorfail($devis_id);
		$demande_cons = DemandeConsultation::find($demande_devis->demande_cons_id);
		$dossier = Dossier::findorfail($demande_cons->dossier_id);
		return view('coordinateur.demandeCons.show_invoices', [
			'invoices' => $invoices,
			'invoice_lines' => $invoice_lines,
			'count' => $count,
			'dossier' => $dossier
		]);
	}

	public function showInvoice($id)
	{
		$invoice = Invoice::select(
			'invoices.id',
			'invoices.tva',
			'invoices.total_ht',
			'invoices.total_ttc',
			'invoices.currency',
			'invoices.demande_devis_id',
			'invoices.status',
			'status_invoices.lib as status_lib',
			'invoices.sender_id',
			DB::raw("concat(users.prenom,' ',users.nom) as sender"),
			'users.email',
			'users.tel',
			'users.rue',
			'users.cp',
			'users.country_id',
			'users.ville_id',
			'invoices.receiver_id',
			'invoices.note',
			'invoices.payment_info',
			'invoices.created_at',
			'invoices.date',
			'invoices.due_date'
		)
			->leftJoin('status_invoices', 'invoices.status', '=', 'status_invoices.id')
			->leftJoin('users', 'invoices.sender_id', '=', 'users.id')
			->where('invoices.id', '=', $id)
			->first();
		$invoice_lines = InvoiceLine::select(
			'actes.lib as acte',
			'acte_details.lib as description',
			'quantity',
			'prix_unitaire',
			'discount',
			'Prix_ht',
			'Prix_ttc',
		)
			->leftJoin('actes', 'actes.id', '=', 'name')
			->leftJoin('acte_details', 'acte_details.id', '=', 'description')
			->where('invoice_id', '=', $id)
			->get();
		$count = count($invoice_lines);
		$demande_devis = DemandeDevis::findorfail($invoice->demande_devis_id);
		$demande_cons = DemandeConsultation::find($demande_devis->demande_cons_id);
		$dossier = Dossier::findorfail($demande_cons->dossier_id);

		return view('coordinateur.demandeCons.show-invoice', [
			'invoice' => $invoice,
			'invoice_lines' => $invoice_lines,
			'count' => $count,
			'dossier' => $dossier
		]);
	}



	public function annulerDemandeDevis($id)
	{
		$d = DemandeDevis::find($id);
		$temp = Temp::where('id_demande_devis', '=', $id);
		$temp->delete();
		DemandeDevis::where('id', '=', $id)->delete();
		return redirect('coordinateur/demandeCons/demande' . $d->demande_cons_id);
	}
}
