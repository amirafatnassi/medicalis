<?php

namespace App\Http\Controllers\coordinateur;

use App\Http\Controllers\Controller;
use App\Models\DemandeConsultation;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\DemandeInfos;
use App\Models\Invoice;

class notificationController extends Controller
{
	public function dashboard()
	{
		$notifications = auth()->user()->notifications;
		$user = auth()->user();
		return view('coordinateur.dashboard', [
			'notifications' => $notifications,
			'user' => $user
		]);
	}

	public function read($id)
	{
		$notification = Notification::find($id);
		$notification->update(['read_at' => now()]);
		if ($notification->type === "App\Notifications\DemandeInfosNotification")
			DemandeInfos::find($id)->update(['read_at' => now(), 'status_id' => 7]);

		return back()->with('flash', 'Notification mark as read');
	}

	public function prendreEnCharge($notif, $id)
	{
		Notification::find($notif)->update(['read_at' => now()]);
		DemandeConsultation::find($id)->update(['coordinateur_en_charge' => auth::user()->id, 'status_id' => 6]);
		return back()->with('flash', 'Notification mark as read');
	}

	public function readInvoice($id, $notif)
	{
		$notification = Notification::find($notif);
		$notification->update(['read_at' => now()]);
		if ($notification->type === "App\Notifications\SendInvoiceNotification")
			Invoice::find($id)->update(['read_at' => now(), 'status_id' => 2]);

		return redirect('coordinateur/devis/' . $id . '/show');
	}
}
