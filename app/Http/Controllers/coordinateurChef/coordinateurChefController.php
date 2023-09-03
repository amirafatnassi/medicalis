<?php

namespace App\Http\Controllers\coordinateurChef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Country;
use App\Models\Sexe;

class coordinateurChefController extends Controller
{
	public function dashboard()
	{
		$notifications = auth()->user()->notifications;
		$user = auth()->user();
		return view('coordinateurChef.dashboard', [
			'notifications' => $notifications,
			'user' => $user
		]);
	}

	public function myProfil()
	{
		$user = User::select(
			'users.id',
			'users.nom',
			'users.prenom',
			'users.fonction',
			'users.image',
			'users.tel',
			'users.email',
			'sexes.lib as sexe',
			'countries.lib as pays',
			'users.rue',
			'villes.lib as ville',
			'users.cp',
			'roles.lib as role',
			'users.created_at',
			'users.updated_at',
			'users.sexe as sexe_id',
			'users.country_id',
			'users.ville_id',
		)
			->leftJoin('sexes', 'sexes.id', '=', 'users.sexe')
			->leftJoin('countries', 'users.country_id', '=', 'countries.code')
			->leftJoin('villes', 'users.ville_id', '=', 'villes.id')
			->leftJoin('roles', 'users.role_id', '=', 'roles.id')
			->WHERE('users.id', '=', auth::user()->id)
			->first();
		$countries = Country::all();
		$sexes = Sexe::all();

		return view('coordinateurChef.profile', [
			'user' => $user,
			'sexes' => $sexes,
			'countries' => $countries
		]);
	}

		

	public function update_general(Request $request)
	{
		$user = User::FindOrFail(auth::user()->id);
		$user->nom = $request->input('nom');
		$user->prenom = $request->input('prenom');
		$user->tel = $request->input('tel');
		$user->email = $request->input('email');
		if ($request->hasfile('image')) {
			$file = $request->file('image');
			$extension = $file->getClientOriginalExtension();
			$id_image = $request->input('nom') . '-' . $request->input('prenom');
			$filename = $id_image . "-" . time() . '.' . $extension;
			$file->move('uploads/users/', $filename);
			$user->image = $filename;
		}
		$user->save();
		$request->session()->flash('status', 'utilisateur mis à jour ! ');
		return redirect('coordinateurChef/myProfil');
	}
	public function update_information(Request $request)
	{
		$user = User::FindOrFail(auth::user()->id);
		$user->sexe = $request->input('sexe_id');
		$user->country_id = $request->input('pays');
		$user->ville_id = $request->input('state');
		$user->cp = $request->input('cp');
		$user->rue = $request->input('rue');

		$user->save();
		$request->session()->flash('status', 'utilisateur mis à jour ! ');
		return redirect('coordinateurChef/myProfil');
	}


	public function editmdp()
	{
		$user = User::select(
			'users.id',
			'users.nom',
			'users.prenom',
			'users.fonction',
			'users.image',
			'users.tel',
			'users.email',
			'users.sexe as sexe_id',
			'sexes.lib as sexe',
			'users.country_id',
			'countries.lib as pays',
			'users.rue',
			'users.ville_id',
			'villes.lib as ville',
			'users.cp',
			'roles.lib as role',
			'users.created_at',
			'users.updated_at'
		)
			->leftJoin('sexes', 'sexes.id', '=', 'users.sexe')
			->leftJoin('countries', 'users.country_id', '=', 'countries.code')
			->leftJoin('villes', 'users.ville_id', '=', 'villes.id')
			->leftJoin('roles', 'users.role_id', '=', 'roles.id')
			->WHERE('users.id', '=', auth::user()->id)
			->first();
		$countries = Country::all();
		$sexes = Sexe::all();
		return view('coordinateurChef.editmdp', [
			'user' => $user,
			'sexes' => $sexes,
			'countries' => $countries
		]);
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
			return redirect('/coordinateurChef/myProfil');
		} else {
			return redirect()->back();
		}
	}
}
