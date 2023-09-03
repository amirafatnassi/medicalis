<?php

namespace App\Http\Controllers\medecin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\DemandeInfos;

class notificationController extends Controller
{
	public function dashboard()
	{
		$notifications = auth()->user()->notifications;
		$user = auth()->user();
		return view('medecin.dashboard', [
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

	
}
