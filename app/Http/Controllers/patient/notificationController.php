<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Models\GenInvoice;
use App\Models\Notification;

class notificationController extends Controller
{
	public function dashboard()
	{
		$notifications = auth()->user()->notifications;
		$user = auth()->user();
		return view('patient.dashboard', compact('notifications', 'user'));
	}
 
	public function read($id)
	{
		$notification = Notification::find($id);
		$notification->update(['read_at' => now()]);
		if ($notification->type === "App\Notifications\DemandeInfosNotification")
			DemandeInfos::find($id)->update(['read_at' => now(), 'status_id' => 7]);

		return back()->with('flash', 'Notification mark as read');
	}

	public function readInvoice($id, $notif)
	{
		$notification = Notification::find($notif);
		$notification->update(['read_at' => now()]);
		if ($notification->type === "App\Notifications\SendInvoiceNotification")
			GenInvoice::findorFail($id)->update(['read_at' => now(), 'status_id' => 2]);

		return redirect('patient/devis/' . $id . '/show');
	}
}
