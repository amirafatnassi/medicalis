<?php

namespace App\Http\Controllers\medecin;

use App\Http\Controllers\Controller;
use App\Models\DemandeConsultation;
use Illuminate\Support\Facades\Redirect;
use App\Models\DemandeDevis;
use App\Models\Dossier;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class devisController extends Controller
{
	public function store(Request $request)
	{
		$validatedData = $request->validate([
			'id' => 'required|numeric',
			'date' => 'required|date',
			'due_date' => 'required|date',
			'receiver_id' => 'required',
			'payment_info' => 'required',
			'currency' => 'required',
			'tva' => 'required',
			'total_ht' => 'required',
			'total_ttc' => 'required',
			'name' => 'required|array',
			'description' => 'required|array',
			'quantity' => 'required|array',
			'prix_unitaire' => 'required|array',
			'discount' => 'required|array',
			'prix_ht' => 'required|array',
			'prix_ttc' => 'required|array',
		]);

		$year = \Carbon\Carbon::now()->format('Y');
		$sequence = Invoice::whereYear('created_at', $year)->count() + 1;
		$invoice = new Invoice();
		$invoice->id = IdGenerator::generate([
			'table' => 'invoices',
			'field' => 'id',
			'length' => 8,
			'prefix' => $year . $validatedData['id'] . $sequence,
			'reset_on_prefix_change' => true,
		]);

		$invoice->due_date = $validatedData['due_date'];
		$invoice->sender_id = Auth::user()->id;
		$invoice->receiver_id = $validatedData['receiver_id'];
		$invoice->tva = $validatedData['tva'];
		$invoice->currency = $validatedData['currency'];
		$invoice->payment_info = $validatedData['payment_info'];
		$invoice->total_ht =  $validatedData['total_ht'];
		$invoice->total_ttc = $validatedData['total_ttc'];
		$invoice->demande_devis_id = $request->input('demande_devis_id');
		$invoice->status_id = 1;
		$invoice->note = $request->input('note');
		$invoice->date = $request->input('date');
		$invoice->save();

		// Add invoice details
		foreach ($validatedData['name'] as $index => $name) {
			$detail = new InvoiceDetail();
			$detail->name = $name;
			$detail->description = $validatedData['description'][$index];
			$detail->quantity = $validatedData['quantity'][$index];
			$detail->prix_unitaire = $validatedData['prix_unitaire'][$index];
			$detail->discount = $validatedData['discount'][$index];
			$detail->prix_ht = $validatedData['prix_ht'][$index];
			$detail->prix_ttc = $validatedData['prix_ttc'][$index];
			$detail->invoice_id = $invoice->id;
			$invoice->details()->save($detail);
		}

		DemandeDevis::findorFail($request->input('demande_devis_id'))->update(['status_id' => 8]);

		$user = User::find($invoice->sender_id);
		$data = [
			'user' => $user->prenom . ' ' . $user->nom,
			'invoice' => $invoice->id,
		];
		User::find($invoice->receiver_id)->notify(new \App\Notifications\SendInvoiceNotification($data));

		return  redirect('medecin/devis/show-invoice/' . $invoice->id);
	}

	public function showInvoice($id_devis)
	{
		$invoice = Invoice::findorFail($id_devis);
		DemandeDevis::find($invoice->demande_devis_id)->update(['status_id' => 7]);

		return view('medecin.devis.show-invoice', compact('invoice'));
	}

	public function storeInvoiceLine(Request $request)
	{
		$invoice_line = new InvoiceLine();
		$invoice_line->name = $request->input('acte');
		$invoice_line->description = $request->input('state');
		$invoice_line->quantity = $request->input('quantity');
		$invoice_line->prix_unitaire = $request->input('prix_unitaire');

		if ($request->input('discount') === null) $invoice_line->discount = 0;
		else $invoice_line->discount = $request->input('discount');

		$invoice_line->prix_ht = ($invoice_line->quantity * $invoice_line->prix_unitaire) - (($invoice_line->quantity * $invoice_line->prix_unitaire * $invoice_line->discount) / 100);
		$invoice_line->invoice_id = $request->input('invoice_id');
		$invoice = Invoice::find($invoice_line->invoice_id);
		$tva = $invoice->tva;
		$invoice_line->prix_ttc = $invoice_line->prix_ht + ($invoice_line->prix_ht * ($tva / 100));
		$invoice_line->save();
		$invoice->total_ht = $invoice->total_ht + $invoice_line->prix_ht;
		$invoice->total_ttc = $invoice->total_ttc + $invoice_line->prix_ttc;
		$invoice->save();
		return Redirect::back();
	}

	public function create($id_demande_devis)
	{
		$demande_devis = DemandeDevis::find($id_demande_devis);
		$demande_cons = DemandeConsultation::find($demande_devis->demande_cons_id);
		$dossier = Dossier::find($demande_cons->dossier_id);
		$destinataire = User::where('id', '=', $demande_devis->created_by)->first();
		return view('medecin.devis.create', [
			'dossier' => $dossier,
			'demande_devis' => $demande_devis,
			'destinataire' => $destinataire
		]);
	}

	public function printInvoice($id_devis)
	{
		$invoice = Invoice::select(
			'invoices.id',
			'invoices.tva',
			'invoices.total_ht',
			'invoices.total_ttc',
			'invoices.currency',
			'invoices.demande_devis_id',
			'invoices.status_id',
			'status_invoices.lib as status_lib',
			'invoices.sender_id',
			DB::raw("concat(users.prenom,' ',users.nom) as receiver"),
			'invoices.receiver_id',
			'invoices.note',
			'invoices.payment_info',
			'invoices.created_at',
			'invoices.date',
			'invoices.due_date'
		)
			->leftJoin('status_invoices', 'invoices.status', '=', 'status_invoices.id')
			->leftJoin('users', 'invoices.receiver_id', '=', 'users.id')
			->where('invoices.id', '=', $id_devis)
			->first();
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
			->where('invoice_id', '=', $id_devis)->get();
		$date = date("d-m-Y");
		return view('medecin.devis.print-invoice', [
			'invoice' => $invoice,
			'invoice_lines' => $invoice_lines,
			'date' => $date
		]);
	}
}
