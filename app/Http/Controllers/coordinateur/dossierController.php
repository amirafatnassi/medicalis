<?php

namespace App\Http\Controllers\coordinateur;

use App\Http\Controllers\Controller;
use App\Mail\DemandeAccesDossier;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\DossierFile;
use App\Models\DossierUser;
use App\Models\Histeffetmarquant;
use App\Models\Examenbio;
use App\Models\Examenradio;
use App\Models\DossierAccessHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class dossierController extends Controller
{
	public function index()
	{
		$dossiers = Dossier::with('dossierUsers')
			->whereHas('dossierUsers', function ($query) {
				$query->where('user_id', Auth::user()->id);
			})
			->get();
		return view('coordinateur.dossiers.index', compact('dossiers'));
	}

	public function search(Request $request)
	{
		$search = $request->input('search');
		$dossiers = [];

		if ($search) {
			$dossiers = Dossier::where('id', 'like', "%$search%")
				->get();
		}

		return view('coordinateur.dossiers.search', compact('dossiers'));
	}

	public function requestAccess($id_dossier)
	{
		$dossier = Dossier::findorFail($id_dossier);
		$user = User::findorFail($dossier->user_id);
		$coordinateur = User::findorFail(Auth::user()->id);

		Mail::to($user->email)->send(new DemandeAccesDossier($user, $coordinateur, $dossier));
		return view('coordinateur.dossiers.search');
	}

	public function read($id)
	{
		Notification::find($id)->update(['read_at' => now()]);
		return back()->with('flash', 'Notification mark as read');
	}

	public function show($id_dossier)
	{
		$dossier = Dossier::with('files', 'bloodtype', 'user')
			->findorFail($id_dossier);
		return view('coordinateur.dossiers.show', compact('dossier'));
	}

	public function create()
	{
		return view('coordinateur.dossiers.create');
	}

	public function store(Request $request)
	{
		if ($request->input('sexe') == 1) {
			$s = "M";
		} else {
			$s = "F";
		}

		$dossier = new Dossier();
		$id = IdGenerator::generate([
			'table' => 'dossiers', 'field' => 'id', 'length' => 13,
			'prefix' => \Carbon\Carbon::parse($request->input('datenaissance'))->format('dmY') . $s,
			'reset_on_prefix_change' => true
		]);
		$dossier->id = $id;
		$dossier->groupe_sanguin = $request->input('groupe_sanguin');
		$dossier->taille = $request->input('taille');
		$dossier->poids = $request->input('poids');
		$dossier->prenom = $request->input('prenom');
		$dossier->nom = $request->input('nom');
		$dossier->sexe = $request->input('sexe');
		$dossier->profession = $request->input('profession');
		$dossier->convention = $request->input('convention');
		$dossier->datenaissance = $request->input('datenaissance');
		$dossier->lieunaissance = $request->input('lieunaissance');
		$dossier->tel = $request->input('tel');
		$dossier->email = $request->input('email');
		$dossier->contactdurgence = $request->input('contactdurgence');
		$dossier->pays = $request->input('pays');
		$dossier->ville = $request->input('state');
		$dossier->cp = $request->input('cp');
		$dossier->rue = $request->input('rue');
		$dossier->groupe_sanguin = $request->input('groupe_sanguin');
		$dossier->antecedants_med = $request->input('antecedants_med');
		$dossier->antecedants_chirg = $request->input('antecedants_chirg');
		$dossier->antecedants_fam = $request->input('antecedants_fam');
		$dossier->allergies = $request->input('allergies');
		$dossier->indicateur_bio = $request->input('indicateur_bio');
		$dossier->traitement_chr = $request->input('traitement_chr');
		$dossier->created_by = Auth::user()->id;
		if ($request->hasfile('image')) {
			$file = $request->file('image');
			$filename = $request->input('nom') . '_' . $request->input('prenom') . '.' . $file->getClientOriginalExtension();
			$file->move('uploads/dossier/', $filename);
			$dossier->image = $filename;
		}
		if ($files = $request->file('filesup')) {
			foreach ($files as $img) {
				$img->move('uploads/dossierFiles', $dossier->id_dossier . "-" . time() . "-" . $img->getClientOriginalName());
				$photo = new dossierFile;
				$photo->iddossier = $dossier->id;
				$photo->downloads = $dossier->id_dossier . "-" . time() . "-" . $img->getClientOriginalName();;
				$photo->save();
			}
		}
		$dossier->save();

		$dossierUser = new DossierUser();
		$dossierUser->dossier_id = $id;
		$dossierUser->user_id = Auth::user()->id;
		$dossierUser->save();

		return redirect('coordinateur/dossiers/index');
	}

	public function edit($id)
	{
		$dossier = Dossier::findorFail($id);

		return view('coordinateur.dossiers.edit', compact('dossier'));
	}


	public function update_personal(Request $request, $id)
	{
		$dossier = Dossier::findorFail($id);
		$user = User::findorFail($dossier->user_id);
		$user->update([
			'prenom' => $request->input('prenom'),
			'nom' => $request->input('nom'),
			'profession_id' => $request->input('profession'),
			'lieunaissance' => $request->input('lieunaissance'),
			'tel' => $request->input('tel'),
			'email' => $request->input('email'),
		]);
		$dossier->update(['contactdurgence' => $request->input('contactdurgence')]);

		if ($request->hasfile('image')) {
			$file = $request->file('image');
			$filename = $request->input('nom') . '-' . $request->input('prenom') . "-" . time() . '.' . $file->getClientOriginalExtension();
			$file->move('uploads/dossier/', $filename);
			$dossier->image = $filename;
		}

		return  redirect('coordinateur/dossiers/show/' . $id);
	}

	public function update_adress(Request $request, $id)
	{
		$dossier = Dossier::findorFail($id);
		$user = User::findorFail($dossier->user_id);
		$user->update([
			'pays' => $request->input('pays'),
			'ville' => $request->input('state'),
			'cp' => $request->input('cp'),
			'rue' => $request->input('rue')
		]);

		return  redirect('coordinateur/dossiers/show/' . $id);
	}

	public function update_general(Request $request, $id)
	{
		$dossier = Dossier::findorFail($id);
		$dossier->update([
			'groupe_sanguin' => $request->input('groupe_sanguin'),
			'taille' => $request->input('taille'),
			'poids' => $request->input('poids'),
			'convention' => $request->input('convention')
		]);

		return  redirect('coordinateur/dossiers/show/' . $id);
	}

	public function update_files(Request $request, $id)
	{
		if ($files = $request->file('filesup')) {
			foreach ($files as $img) {
				$profileImage = $id . "-" . time() . "-" . $img->getClientOriginalName();
				$img->move('uploads/dossierFiles', $profileImage);
				$photo = new dossierFile;
				$photo->iddossier = $id;
				$photo->downloads = $profileImage;
				$photo->save();
			}
		}
		return  redirect('/coordinateur/dossiers/show/' . $id);
	}

	public function deleteFile($id)
	{
		$file = DossierFile::findorFail($id);
		if ($file) {
			unlink(public_path('../public/uploads/dossierFiles/' . $file->downloads));
			$file->delete();
		}
		return Redirect::back();
	}

	public function deleteDossier($id)
	{
		DossierUser::where('dossier_id', $id)
			->where('user_id', Auth::user()->id)->delete();
		DossierAccessHistory::create([
			'dossier_id' => $id,
			'user_id' => Auth::user()->id,
			'granted' => 0,
			'created_by' => Auth::user()->id

		]);
		return Redirect::back();
	}

	public function historiques($id_dossier)
	{
		$dossier = Dossier::findorFail($id_dossier);

		$consultation = Consultation::with('motif', 'medecin', 'files')
			->select('*', DB::raw("'consultation' as type"))
			->where('dossier_id', $id_dossier)
			->where('medecin_id', Auth::user()->id)
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

		return view('coordinateur.dossiers.historiques', compact('consultation', 'examenBio', 'examenRadio', 'dossier'));
	}

	public function effetsmarquants($id_dossier)
	{
		$dossier = Dossier::findorFail($id_dossier);

		$consultations = Consultation::with('motif', 'medecin', 'files')
			->where('dossier_id', $id_dossier)
			->where('medecin_id', Auth::user()->id)
			->where('effet_marquant', 1)
			->orderBy('date', 'desc')
			->get();
		return view('coordinateur.dossiers.effetsmarquants', compact('consultations', 'dossier'));
	}

	public function deleteHistorique($id)
	{
		$Histeffetmarquant = new Histeffetmarquant();
		$Histeffetmarquant->id_consultation = $id;
		$Histeffetmarquant->id_user = Auth::user()->id;
		$Histeffetmarquant->save();
		$consultation = Consultation::find($id);
		$consultation->effet_marquant = 0;
		$consultation->save();
		return Redirect::back();
	}

	public function listeSupprimer($id_dossier)
	{
		$dossier = Dossier::findorfail($id_dossier);
		dd($dossier);
		$results = Histeffetmarquant::all();

		return view('coordinateur.dossiers.listeSupprimer', compact('dossier', 'liste_consultations'));
	}
}
