<?php

namespace App\Http\Controllers\medecin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Dossier;
use App\Models\User;
use App\Models\Consultation;
use App\Models\Consultationfiles;
use Auth;

class consultationController extends Controller
{
    public function index($id)
    {
        $dossier = Dossier::findorFail($id);
        $liste_consultations = Consultation::where('dossier_id', $id)->get();

        return view('medecin.consultations.index', compact('dossier', 'liste_consultations'));
    }

    public function create($id)
    {
        $dossier = Dossier::findorFail($id);
        return view('medecin.consultations.create', compact('dossier'));
    }

    public function edit($id)
    {
        $consultation = Consultation::findorFail($id);
        $dossier = Dossier::findorFail($consultation->dossier_id);

        return view('medecin.consultations.edit', compact('consultation', 'dossier'));
    }

    public function update(Request $request, $id)
    {
        if ($request->has('effet_marquant')) {
            $effet = 1;
        } else {
            $effet = 0;
        }
        $c = Consultation::FindOrFail($id);
        $c->date = $request->input('date');
        $c->motif = $request->input('motif');
        $c->taille = $request->input('taille');
        $c->poids = $request->input('poids');
        $c->ta = $request->input('ta');
        $c->observation = $request->input('observation');
        $c->observation_prive = $request->input('observation_prive');
        $c->effet_marquant = $effet;
        $c->effet_marquant_txt = $request->input('effet_marquant_txt');
        if ($files = $request->file('filesup')) {
            $destinationPath = public_path('uploads/consultation/');
            foreach ($files as $img) {
                $profileImage = $c->dossier_id . "-" . time() . "-" . $img->getClientOriginalName();
                $img->move($destinationPath, $profileImage);
                $photo = new Consultationfiles;
                $photo->idConsultation = $c->id;
                $photo->downloads = $profileImage;
                $photo->save();
            }
        }
        $c->save();
        return  redirect('medecin/consultation/' . $id . '/show');
    }

    public function deleteFile($id)
    {
        $file = Consultationfiles::findorFail($id);
        if ($file) {
            unlink(public_path('uploads/consultation/' . $file->downloads));
            $file->delete();
        }
        return Redirect::back();
    }

    public function show($idC)
    {
        $consultation = Consultation::findorFail($idC);
        $dossier = Dossier::findorFail($consultation->dossier_id);

        return view('medecin.consultations.show', compact('consultation', 'dossier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'observation' => 'required',
        ]);
        $consultation = new Consultation();
        $consultation->effet_marquant = $request->has('effet_marquant') ? 1 : 0;
        $consultation->effet_marquant_txt = $request->has('effet_marquant') ? $request->input('effet_marquant_txt') : '';
        $consultation->dossier_id =  $request->input('id_dossier');
        $consultation->medecin_id = Auth::user()->id;
        $consultation->observation = $request->input('observation');
        $consultation->created_by = Auth::user()->id;

        $consultation->fill($request->only($consultation->getfillable()));
        $consultation->save();

        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $img->move('uploads/consultation/', $consultation->dossier_id . "-" . time() . "-" . $img->getClientOriginalName());
                $photo = new Consultationfiles;
                $photo->idConsultation = $consultation->id;
                $photo->downloads = $consultation->dossier_id . "-" . time() . "-" . $img->getClientOriginalName();
                $photo->save();
            }
        }

        $dossier = Dossier::findorFail($consultation->dossier_id);
        $dossier->update(['taille' => $request->input('taille'), 'poids' => $request->input('poids')]);

        //envoie Mail
        $find = User::findorFail(Auth::user()->id);
        $data = array(
            'name' => "cher " . $dossier->nom . " " . $dossier->prenom,
            'message' => "Dr " . $find->nom . " " . $find->prenom . " est en train d'ajouter nouveau consultation dans votre dossier"
        );
        // Mail::to($mail_patient)->send(new SecuriteMailPatient($data));
        return  redirect('medecin/' . $consultation->dossier_id . '/consultation');
    }

    public function showExamenfiles($id)
    {
        $consultation = Consultation::findorFail($id);
        $files = $consultation->files;
        $dossier = Dossier::findorFail($consultation->dossier_id);

        return view('medecin.consultations.files', compact('dossier','files'));
    }
}
