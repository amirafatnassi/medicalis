<?php

namespace App\Http\Controllers\medecin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\Examenbio;
use App\Models\Exbiofiles;
use App\Models\Dossier;
use Auth;

class examenbioController extends Controller
{
    public function index($id_dossier)
    {
        $liste_examenbios = Examenbio::with('files', 'medecin')
            ->where('dossier', $id_dossier)
            ->get();
        $dossier = Dossier::findorFail($id_dossier);
        return view('medecin.examenbios.index', compact('dossier', 'liste_examenbios'));
    }

    public function create($id_dossier)
    {
        $dossier = Dossier::findorFail($id_dossier);
        return view('medecin.examenbios.create', compact('dossier'));
    }

    public function edit($idC)
    {
        $examenbio = Examenbio::with('files', 'medecin')->findorFail($idC);
        $dossier = Dossier::findorFail($examenbio->dossier);

        return view('medecin.examenbios.edit', compact('dossier', 'examenbio'));
    }

    public function update(Request $request, $id)
    {
        $examenbio = Examenbio::FindOrFail($id);
        $examenbio->fill($request->only($examenbio->getfillable()));
        $option = $request->input('option');
        $examenbio->url_bio = ($option === 'Autres') ? $request->input('url_bio') : $option;
        $examenbio->save();

        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $profileImage = "$examenbio->dossier" . "-" . time() . "-" . $img->getClientOriginalName();
                $img->move(public_path('uploads/exbio/'), $profileImage);
                $request->session()->flash('alert-success', 'file was successful added!');
                $photo = new exbiofiles;
                $photo->idexbio = $examenbio->id;
                $photo->downloads = $profileImage;
                $photo->save();
            }
        }
        return  redirect('/medecin/examenbio/' . $id . '/show');
    }

    public function show($idC)
    {
        $examenbio = Examenbio::with('files', 'medecin')->findorFail($idC);
        $dossier = Dossier::findorFail($examenbio->dossier);
        return view('medecin.examenbios.show', compact('dossier', 'examenbio'));
    }

    public function store(Request $request)
    {
        $examenbio = new Examenbio();
        $examenbio->id_medecin = Auth::user()->id;
        $examenbio->lettre = $request->input('lettre');
        $examenbio->date = $request->input('date');
        if (($request->input('option')) == 'Autres') {
            $examenbio->url_bio = $request->input('url_bio');
        } else {
            $examenbio->url_bio = $request->input('option');
        }
        $examenbio->dossier = $request->input('dossier');
        $examenbio->save();
        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $profileImage = $examenbio->dossier . "-" . time() . "-" . $img->getClientOriginalName();
                $img->move(public_path('uploads/exbio/'), $profileImage);
                $photo = new exbiofiles;
                $photo->idexbio = $examenbio->id;
                $photo->downloads = $profileImage;
                $photo->save();
            }
        }
        return  redirect('/medecin/examenbio/' . $examenbio->id . '/show');
    }

    public function showExamenfiles($id)
    {
        $examenradio = Examenbio::findorFail($id);
        $dossier = Dossier::findorFail($examenradio->dossier);
        $files = Exbiofiles::where('idexbio', $id)->get();
        return view('medecin.examenbios.files', compact('files', 'dossier'));
    }

    public function deleteFile($id)
    {
        $file = Exbiofiles::findorFail($id);
        if ($file) {
            unlink(public_path('uploads/exbio/' . $file->downloads));
            $file->delete();
        }
        return Redirect::back();
    }

    public function urlBio($id)
    {
        $exbio = Examenbio::findorFail($id);
        return redirect()->away('http://' . $exbio->url_bio . '/');
    }
}
