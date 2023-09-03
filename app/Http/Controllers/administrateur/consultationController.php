<?php

namespace App\Http\Controllers\administrateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Dossier;
use App\Models\Consultation;
use App\Models\Consultationfiles;

class consultationController extends Controller
{
    public function index($id_dossier)
    {
        $dossier = Dossier::findorfail($id_dossier);
        $liste_consultations = Consultation::with('files', 'medecin', 'medecin.specialty', 'Motif')
            ->WHERE('id_dossier', '=', $id_dossier)
            ->orderBy('date', 'DESC')
            ->get();

        return view('administrateur.dossiers.consultations.index', compact('dossier', 'liste_consultations'));
    }

    public function create($id_dossier)
    {
        $dossier = Dossier::findorfail($id_dossier);
        return view('administrateur.dossiers.consultations.create', compact('dossier'));
    }

    public function edit($idC)
    {
        $consultation = Consultation::with('files', 'Motif', 'medecin', 'medecin.Specialty')
            ->findorFail($idC);
        $dossier = Dossier::findorfail($consultation->id_dossier);

        return view('administrateur.dossiers.consultations.edit', compact('consultation', 'dossier'));
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

        return  redirect('/administrateur/dossiers/consultations/show/' . $id);
    }

    public function deleteFile($id)
    {
        $file = Consultationfiles::findorFail($id);
        if ($file) {
            unlink(public_path('../public/uploads/consultation/' . $file->downloads));
            $file->delete();
        }
        return Redirect::back();
    }

    public function show($idC)
    {
        $consultation = Consultation::with('files', 'Motif', 'medecin', 'medecin.Specialty')
            ->findorFail($idC);
        $dossier = Dossier::findorfail($consultation->id_dossier);
        return view('administrateur.dossiers.consultations.show', compact('consultation', 'dossier'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'observation' => 'required',
        ]);
        $consultation = new Consultation();
        $consultation->effet_marquant = $request->has('effet_marquant') ? 1 : 0;
        $consultation->created_by = Auth::user()->id;
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
        $dossier = Dossier::findorFail($request->input('id_dossier'));
        $dossier->update(['taille' => $request->input('taille'), 'poids' => $request->input('poids')]);

        return  redirect('/administrateur/dossiers/consultations/show/' . $consultation->id);
    }

    public function showExamenfiles($id)
    {
        $dossier = Consultation::findorfail($id)->first();
        $dossier = Dossier::findorfail($dossier->id_dossier)->first();
        $files = ConsultationFiles::where('idConsultation', '=', $id)->get();
        return view('administrateur.dossiers.consultations.files', [
            'files' => $files,
            'dossier' => $dossier
        ]);
    }
}
