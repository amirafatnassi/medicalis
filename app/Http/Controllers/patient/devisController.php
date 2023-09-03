<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Models\GenInvoice;

class devisController extends Controller
{
	public function show($id)
	{
		$invoice = GenInvoice::findorFail($id);

		return view('patient.devis.show', compact('invoice'));
	}
}
