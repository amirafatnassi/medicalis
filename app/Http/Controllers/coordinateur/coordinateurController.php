<?php

namespace App\Http\Controllers\coordinateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class coordinateurController extends Controller
{
	public function myProfil()
	{
		$user = User::findorFail(auth::user()->id);

		return view('coordinateur.profile', compact('user'));
	}

	public function update_general(Request $request)
	{
		$user = User::FindOrFail(auth::user()->id);
		$user->update(['nom' => $request->input('nom'),
		'prenom' => $request->input('prenom'),
		'tel' => $request->input('tel'),
		'email' => $request->input('email')]);

		if ($request->hasfile('image')) {
			$file = $request->file('image');
			$extension = $file->getClientOriginalExtension();
			$id_image = $request->input('nom') . '-' . $request->input('prenom');
			$filename = $id_image . "-" . time() . '.' . $extension;
			$file->move('uploads/users/', $filename);
			$user->image = $filename;
		}
		
		return redirect('coordinateur/myProfil');
	}

	public function update_information(Request $request)
	{
		$user = User::FindOrFail(auth::user()->id);
		$user->update([
			'sexe_id' => $request->input('sexe_id'),
			'country_id' => $request->input('pays'),
			'ville_id' => $request->input('state'),
			'cp' => $request->input('cp'),
			'rue' => $request->input('rue')
		]);

		return redirect('coordinateur/myProfil');
	}

	public function updatemdp(Request $req)
	{
		$user = User::find(auth::user()->id);
		$valid = validator($req->only('ampd', 'nmpd', 'cmpd'), [
			'ampd' => 'required|string',
			'nmpd' => 'required|string|different:ampd',
			'cmpd' => 'required_with:nmpd|same:nmpd|string',
		], [
			'nmpd.required_with' => 'Retapez le nouveau mot de passe.'
		]);

		if ($valid->fails()) {
			return response()->json([
				'errors' => $valid->errors(),
				'message' => 'Erreur.',
				'status' => false
			], 200);
		}
		$mdp = $user->password;
		$ampd = $req->input('ampd');
		if (Hash::check($ampd, $mdp)) {
			$user->password = Hash::make($req->input('nmpd'));
			$user->save();
			return redirect('/coordinateur/myProfil');
		} else {
			return redirect()->back();
		}
	}
}
