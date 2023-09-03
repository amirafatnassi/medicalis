<?php

namespace App\Http\Controllers\coordinateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\DemandeDevis;
use App\Models\DemandeConsultation;
use App\Models\GenInvoice;
use App\Models\GenInvoiceDetail;
use App\Models\GenInvoiceLine;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class devisController extends Controller
{
	public function create($id)
	{
		$demandeCons = DemandeConsultation::findorFail($id);
		$dossier = Dossier::find($demandeCons->dossier_id);
		$destinataire = User::findorFail($demandeCons->created_by);
		return view('coordinateur.devis.create', compact('dossier', 'demandeCons', 'destinataire'));
	}

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
		$invoice = new GenInvoice();
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
		$invoice->demande_cons_id = $request->input('demande_cons_id');
		$invoice->status_id = 1;
		$invoice->note = $request->input('note');
		$invoice->date = $request->input('date');
		$invoice->save();

		// Add invoice details
		foreach ($validatedData['name'] as $index => $name) {
			$detail = new GenInvoiceDetail();
			$detail->name = $name;
			$detail->description = $validatedData['description'][$index];
			$detail->quantity = $validatedData['quantity'][$index];
			$detail->prix_unitaire = $validatedData['prix_unitaire'][$index];
			$detail->discount = $validatedData['discount'][$index];
			$detail->prix_ht = $validatedData['prix_ht'][$index];
			$detail->prix_ttc = $validatedData['prix_ttc'][$index];
			$detail->gen_invoice_id = $invoice->id;
			$invoice->details()->save($detail);
		}

		DemandeConsultation::findorFail($invoice->demande_cons_id)->update(['status_id' => 8]);
		$user = User::find($invoice->sender_id);
		$data = [
			'user' => $user->prenom . ' ' . $user->nom,
			'invoice' => $invoice->id,
		];
		User::find($invoice->receiver_id)->notify(new \App\Notifications\SendInvoiceNotification($data));

		return  redirect('coordinateur/devis/' . $invoice->id . '/show');
	}

	public function show($id)
	{
		$invoice = GenInvoice::findorFail($id);

		return view('coordinateur.devis.show', compact('invoice'));
	}

	public function send($id_invoice)
	{
		$invoice = GenInvoice::where('id', '=', $id_invoice)->firstOrFail();
		$invoice->update(['status_id' => 1]);

		DemandeConsultation::find($invoice->demande_cons_id)->update(['status_id' => 8]);

		$user = User::find($invoice->sender_id);
		$data = [
			'user' => $user->prenom . ' ' . $user->nom,
			'invoice' => $invoice->id,
		];
		User::find($invoice->receiver_id)->notify(new \App\Notifications\SendInvoiceNotification($data));
		return  redirect('coordinateur/devis/' . $id_invoice . '/print');
	}

	public function storeInvoiceLine(Request $request)
	{
		$invoice_line = new GenInvoiceLine();
		$invoice_line->name = $request->input('acte');
		$invoice_line->description = $request->input('state');
		$invoice_line->quantity = $request->input('quantity');
		$invoice_line->prix_unitaire = $request->input('prix_unitaire');

		if ($request->input('discount') === null) $invoice_line->discount = 0;
		else $invoice_line->discount = $request->input('discount');

		$invoice_line->prix_ht = ($invoice_line->quantity * $invoice_line->prix_unitaire) - (($invoice_line->quantity * $invoice_line->prix_unitaire * $invoice_line->discount) / 100);
		$invoice_line->gen_invoice_id = $request->input('invoice_id');
		$invoice = GenInvoice::find($invoice_line->gen_invoice_id);
		$tva = $invoice->tva;
		$invoice_line->prix_ttc = $invoice_line->prix_ht + ($invoice_line->prix_ht * ($invoice->tva / 100));
		$invoice_line->save();
		$invoice->total_ht = $invoice->total_ht + $invoice_line->prix_ht;
		$invoice->total_ttc = $invoice->total_ttc + $invoice_line->prix_ttc;
		$invoice->save();
		return Redirect::back();
	}

	public function print($id_devis)
	{

		$invoice = GenInvoice::select(
			'gen_invoices.id',
			'gen_invoices.tva',
			'gen_invoices.total_ht',
			'gen_invoices.total_ttc',
			'gen_invoices.currency',
			'gen_invoices.demande_cons_id',
			'gen_invoices.status',
			'status_invoices.lib as status_lib',
			'gen_invoices.sender_id',
			DB::raw("concat(users.prenom,' ',users.nom) as receiver"),
			'gen_invoices.receiver_id',
			'gen_invoices.note',
			'gen_invoices.payment_info',
			'gen_invoices.created_at',
			'gen_invoices.date',
			'gen_invoices.due_date'
		)
			->leftJoin('status_invoices', 'gen_invoices.status', '=', 'status_invoices.id')
			->leftJoin('users', 'gen_invoices.receiver_id', '=', 'users.id')
			->where('gen_invoices.id', '=', $id_devis)
			->first();
		$invoice_lines = GenInvoiceLine::select(
			'actes.lib as acte',
			'acte_details.lib as description',
			'quantity',
			'prix_unitaire',
			'discount',
			'Prix_ht',
			'Prix_ttc',
		)->leftJoin('actes', 'actes.id', '=', 'name')
			->leftJoin('acte_details', 'acte_details.id', '=', 'description')
			->where('gen_invoice_id', '=', $id_devis)->get();
		$date = date("d-m-Y");
		return view('coordinateur.devis.print', [
			'invoice' => $invoice,
			'invoice_lines' => $invoice_lines,
			'date' => $date
		]);
	}
}
