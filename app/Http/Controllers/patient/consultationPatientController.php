<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Dossier;
use App\Models\Consultation;
use App\Models\Consultationfiles;
use Auth;


class consultationPatientController extends Controller
{

    public function index()
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $liste_consultations = Consultation::where('dossier_id', $dossier->id)
            ->get();

        return view('patient.consultations.index', compact('dossier', 'liste_consultations'));
    }

    public function show($id)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $consultation = Consultation::with('Motif', 'files')
            ->where('id_dossier', '=', $dossier->id)
            ->findOrFail($id);

        return view('patient.consultations.show', compact('dossier', 'consultation'));
    }

    public function edit($id)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $consultation = Consultation::with('Motif', 'files')
            ->where('id_dossier', '=', $dossier->id)
            ->findOrFail($id);

        return view('patient.consultations.edit', compact('dossier', 'consultation'));
    }

    public function update(Request $request, $id)
    {
        $consultation = Consultation::FindOrFail($id);
        $consultation->effet_marquant = $request->has('effet_marquant') ? 1 : 0;
        $consultation->fill($request->only($consultation->getfillable()));
        $consultation->save();
        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $img->move('uploads/consultation/', $consultation->id_dossier . "-" . time() . "-" . $img->getClientOriginalName());
                $photo = new Consultationfiles;
                $photo->idConsultation = $consultation->id;
                $photo->downloads = $consultation->id_dossier . "-" . time() . "-" . $img->getClientOriginalName();
                $photo->save();
            }
        }
        return redirect('/patient/consultations/' . $id . '/show');
    }

    public function showConsultationFiles($id)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $files = Consultationfiles::where('idConsultation', '=', $id)->get();
        return view('patient.consultations.files', compact('dossier', 'files'));
    }

    public function create()
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        return view('patient.consultations.create', compact('dossier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'observation' => 'required',
        ]);

        $dossier = Dossier::where('user_id', 5)->first();
        $consultation = new Consultation();
        $consultation->effet_marquant = $request->has('effet_marquant') ? 1 : 0;
        $consultation->id_dossier = $dossier->id;
        $consultation->remarques = "saisie par le patient !";
        $consultation->observation = $request->input('observation');
        $consultation->fill($request->only($consultation->getfillable()));
        $consultation->save();

        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $img->move('uploads/consultation/', $consultation->id_dossier . "-" . time() . "-" . $img->getClientOriginalName());
                $photo = new Consultationfiles;
                $photo->idConsultation = $consultation->id;
                $photo->downloads = $consultation->id_dossier . "-" . time() . "-" . $img->getClientOriginalName();
                $photo->save();
            }
        }
        $dossier = Dossier::findorFail($consultation->id_dossier);
        $dossier->update(['taille' => $request->input('taille'), 'poids' => $request->input('poids')]);
        return redirect('/patient/consultations/' . $consultation->id . '/show');
    }

    public function deleteFile($id)
    {
        $file = Consultationfiles::find($id);
        if ($file) {
            unlink(public_path('../uploads/consultation/' . $file->downloads));
            $file->delete();
        }
        return Redirect::back();
    }
}
