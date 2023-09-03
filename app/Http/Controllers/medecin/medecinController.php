<?php

namespace App\Http\Controllers\medecin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Models\Dossier;
use App\Models\User;
use App\Models\DossierFile;
use App\Models\Examenbio;
use App\Models\Examenradio;
use App\Models\Histeffetmarquant;
use Auth;

class medecinController extends Controller
{
	public function index()
	{
		$dossiers = Dossier::with('dossierUsers')
			->whereHas('dossierUsers', function ($query) {
				$query->where('user_id', Auth::user()->id);
			})
			->get();

		return view('medecin.index', compact('dossiers'));
	}

	public function show($id_dossier)
	{
		$dossier = Dossier::with(['bloodtype', 'user', 'files'])
			->findOrFail($id_dossier);
		return view('medecin.show', compact('dossier'));
	}

	public function edit($id_dossier)
	{
		$dossier = Dossier::with('bloodtype', 'files')
			->findOrFail($id_dossier);
		return view('medecin.edit', compact('dossier'));
	}

	public function profile()
	{
		$medecin = User::with('Specialite', 'Sexe', 'Country', 'Ville', 'Organisme')
			->findorFail(Auth::user()->id);
		return view('medecin.profile', compact('medecin'));
	}

	public function editMonProfil()
	{
		$medecin = User::with('Specialite', 'Sexe', 'Country', 'Ville', 'Organisme')
			->findorFail(Auth::user()->id);
		return view('medecin.editMonProfil', compact('medecin'));
	}

	public function updateMonProfil(Request $request)
	{
		$medecin = User::findOrFail(Auth::user()->id);
		$input = $request->only(['nom', 'prenom', 'sexe', 'organisme', 'specialite', 'tel', 'email', 'pays', 'ville', 'url_pacs', 'url_bio', 'cp', 'rue']);
		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$extension = $file->getClientOriginalExtension();
			$filename = $request->input('nom') . '-' . $request->input('prenom') . '-' . time() . '.' . $extension;
			$file->move('uploads/users/', $filename);
			$input['image'] = $filename;
		}
		$medecin->fill($input);
		$medecin->save();
		return redirect('medecin/profile');
	}

	public function update(Request $request, $id)
	{
		$dossier = Dossier::FindOrFail($id);
		$input = $request->only(['taille', 'poids', 'groupe_sanguin', 'antecedants_med', 'antecedants_chirg', 'antecedants_fam', 'allergies', 'indicateur_bio', 'traitement_chr']);
		if ($request->hasfile('image')) {
			$file = $request->file('image');
			$extension = $file->getClientOriginalExtension();
			$filename = $request->input('nom') . '_' . $request->input('prenom') . '.' . $extension;
			$file->move('uploads/dossier/', $filename);
			$dossier->image = $filename;
		}
		if ($files = $request->file('filesup')) {
			$destinationPath = public_path('../uploads/dossierFiles/');
			foreach ($files as $img) {
				$profileImage = "$dossier->id" . "-" . time() . "-" . $img->getClientOriginalName();
				$img->move($destinationPath, $profileImage);
				$photo = new DossierFile();
				$photo->idDossier = $dossier->id;
				$photo->downloads = "$profileImage";
				$photo->save();
			}
		}
		$dossier->fill($input);
		$dossier->save();
		return redirect('medecin/show/' . $dossier->id);
	}

	public function update_personal(Request $request, $id)
	{
		if ($request->hasfile('avatar')) {
			$request->validate(['avatar' => ['required', 'image', 'mimes:jpg,png', 'max:2048']]); // max size is 2MB, only allow JPG and PNG files]);
		}
		$dossier = Dossier::findorFail($id);
		$dossier->fill($request->only(['prenom', 'nom', 'profession', 'lieunaissance', 'tel', 'email', 'contactdurgence',]));
		if ($request->hasfile('avatar')) {
			$file = $request->file('avatar');
			$filename = $request->input('nom') . '-' . $request->input('prenom') . "-" . time() . '.' . $file->getClientOriginalExtension();
			$file->move('uploads/dossier/', $filename);
			$dossier->image = basename($filename); // save only the filename without the path
		}
		$dossier->save();
		return  redirect('medecin/show/' . $id);
	}

	public function update_adress(Request $request, $id)
	{
		$dossier = Dossier::findorFail($id);
		$dossier->fill($request->only(['pays', 'ville', 'cp', 'rue']));
		$dossier->save();
		return  redirect('medecin/show/' . $id);
	}

	public function update_general(Request $request, $id)
	{
		$dossier = Dossier::findorFail($id);
		$dossier->fill($request->only(['groupe_sanguin', 'taille', 'poids']));
		$dossier->save();
		return  redirect('/medecin/show/' . $id);
	}

	public function update_medical(Request $request, $id)
	{
		$dossier = Dossier::where('id', $id)->firstOrFail();
		$dossier->fill($request->only(['antecedants_med', 'antecedants_chirg', 'antecedants_fam', 'allergies', 'indicateur_bio', 'traitement_chr']));
		$dossier->save();
		return  redirect('medecin/show/' . $id);
	}

	public function update_files(Request $request, $id)
	{
		if ($files = $request->file('files')) {
			foreach ($files as $img) {
				$profileImage = $id . "-" . time() . "-" . $img->getClientOriginalName();
				$img->move('uploads/dossierFiles', $profileImage);
				$photo = new dossierFile;
				$photo->iddossier = $id;
				$photo->downloads = $profileImage;
				$photo->save();
			}
		}
		return  redirect('medecin/show/' . $id);
	}

	public function editmdp($id)
	{
		$medecin = User::findorFail(Auth::user()->id);
		return view('medecin.editmdp', compact('medecin'));
	}

	public function storeeditmdp(Request $req, $id)
	{
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
			return redirect('/medecin/profile');
		} else {
			return redirect()->back();
		}
	}

	public function deleteFile($id)
	{
		$file = DossierFile::findorFail($id);
		if ($file) {
			unlink(public_path('../uploads/dossierFiles/' . $file->downloads));
			$file->delete();
		}
		return redirect()->back();
	}

	public function historiques($id_dossier)
	{
		$dossier = Dossier::findorFail($id_dossier);

		$consultation = Consultation::with('motif', 'medecin', 'files')
			->select('*', DB::raw("'consultation' as type"))
			->where('id_dossier', $id_dossier)
			->where('id_medecin', Auth::user()->id)
			->orWhere('remarques', "saisie par le patient !")
			->orderBy('date', 'desc')
			->get();

		$examenBio = Examenbio::with('medecin', 'files')
			->select('*', DB::raw("'examenbio' as type"))
			->where('dossier', $id_dossier)
			->where('id_medecin', Auth::user()->id)
			->orWhere('remarques', "saisie par le patient !")
			->orderBy('date', 'desc')
			->get();

		$examenRadio = Examenradio::with('medecin', 'files')
			->select('*', DB::raw("'examenradio' as type"))
			->where('dossier', $id_dossier)
			->where('id_medecin', Auth::user()->id)
			->orWhere('remarques', "saisie par le patient !")
			->orderBy('date', 'desc')
			->get();

		return view('medecin.historiques', compact('consultation', 'examenBio', 'examenRadio', 'dossier'));
	}

	public function historiques_medecin($id_dossier)
	{
		$dossier = Dossier::findorFail($id_dossier);

		$consultation = Consultation::with('motif', 'medecin', 'files')
			->select('*', DB::raw("'consultation' as type"))
			->where('id_dossier', $id_dossier)
			->where('id_medecin', Auth::user()->id)
			->orderBy('date', 'desc')
			->get();

		$examenBio = Examenbio::with('medecin', 'files')
			->select('*', DB::raw("'examenbio' as type"))
			->where('dossier', $id_dossier)
			->where('id_medecin', Auth::user()->id)
			->orderBy('date', 'desc')
			->get();

		$examenRadio = Examenradio::with('medecin', 'files')
			->select('*', DB::raw("'examenradio' as type"))
			->where('dossier', $id_dossier)
			->where('id_medecin', Auth::user()->id)
			->orderBy('date', 'desc')
			->get();

		return view('medecin.historiques_medecin', compact('consultation', 'examenBio', 'examenRadio', 'dossier'));
	}

	public function effetsmarquants($id_dossier)
	{
		$dossier = Dossier::findorFail($id_dossier);

		$consultations = Consultation::with('motif', 'medecin', 'files')
			->where('id_dossier', $id_dossier)
			->where('id_medecin', Auth::user()->id)
			->where('effet_marquant', 1)
			->orderBy('date', 'desc')
			->get();

		return view('medecin.effetsmarquants', compact('dossier', 'consultations'));
	}

	public function destroyEffetMarquant(Request $request, $id)
	{
		$Histeffetmarquant = new Histeffetmarquant();
		$Histeffetmarquant->id_consultation = $id;
		$Histeffetmarquant->id_user = Auth::user()->id;
		$Histeffetmarquant->save();

		Consultation::findorFail($id)->update(['effet_marquant' => 0]);

		return Redirect::back();
	}

	public function effetsmarquantsSupprimer()
	{
		$liste_effets = Histeffetmarquant::with('user', 'consultation')->get();

		return view('medecin.listeSupprimer', compact('liste_effets'));
	}

	public function tousmedecins()
	{
		$listMedecins = User::with('specialty', 'country', 'Ville', 'Organism')->get();

		return view('medecin.tousmedecins', compact('listMedecins'));
	}

	public function destroymedecin($id)
	{
		$id_med = Auth::guard()->id();
		$r = DB::select(DB::raw('select dossiers.id from dossiers where id=' . $id));
		DB::delete('delete from dossier_medecins where dossier_id = ? and medecin_id = ?', [$r[0]->id, $id_med]);
		return redirect('/medecin');
	}

	public function getDefaultUrl(Request $request)
	{
		$url = DB::table("medecins")->where("id", $request->id_medecin)->pluck("url_bio");
		return response()->json($url);
	}
}
