<?php

namespace App\Http\Controllers\administrateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Examenbio;
use App\Models\Exbiofiles;
use App\Models\Dossier;
use App\Models\User;

class examenbioController extends Controller
{
    public function index($id_dossier)
    {
        $dossier = Dossier::findorfail($id_dossier);
        $liste_examenbios = Examenbio::with('files', 'medecin')
            ->where('dossier', $id_dossier)
            ->orderBy('date', 'DESC')
            ->get();
        return view('administrateur.dossiers.examenbios.index', compact('dossier', 'liste_examenbios'));
    }

    public function create($id_dossier)
    {
        $dossier = Dossier::findorfail($id_dossier);
        return view('administrateur.dossiers.examenbios.create', ['dossier' => $dossier]);
    }

    public function edit($idC)
    {
        $examenbio = Examenbio::with('files','medecin','user')
            ->findorFail($idC);
        $dossier = Dossier::findorfail($examenbio->dossier)->first();
        return view('administrateur.dossiers.examenbios.edit', compact('dossier', 'examenbio'));
    }

    public function update(Request $request, $id)
    {
        $examenbio = Examenbio::FindOrFail($id);
        $examenbio->lettre = $request->input('lettre');
        $examenbio->date = $request->input('date');
        $examenbio->id_medecin = $request->input('id_medecin');
        if (($request->input('option')) == 'Autres') {
            $examenbio->url_bio = $request->input('url_bio');
        } else {
            $examenbio->url_bio = $request->input('option');
        }
        $examenbio->save();

        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $img->move('uploads/exbio/', $examenbio->dossier . "-" . time() . "-" . $img->getClientOriginalName());
                $request->session()->flash('alert-success', 'file was successful added!');
                $photo = new exbiofiles;
                $photo->idexbio = $examenbio->id;
                $photo->downloads = $examenbio->dossier . "-" . time() . "-" . $img->getClientOriginalName();
                $photo->save();
            }
        }
        return  redirect('/administrateur/dossiers/examenbios/show/' . $id);
    }

    public function show($idC)
    {
        $examenbio = Examenbio::with('files', 'medecin')
            ->findorFail($idC);
        $dossier = Dossier::findorfail($examenbio->dossier);
        return view('administrateur.dossiers.examenbios.show', compact('dossier', 'examenbio'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'lettre' => 'required',
        ]);
        $examenbio = new Examenbio();

        if (($request->input('url')) == 'Autres') {
            $examenbio->url_bio = $request->input('url_bio');
        } else {
            $examenbio->url_bio = $request->input('url');
        }
        $examenbio->fill($request->only($examenbio->getfillable()));
        $examenbio->save();
        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $img->move('uploads/exbio/', $examenbio->dossier . "-" . time() . "-" . $img->getClientOriginalName());
                $request->session()->flash('alert-success', 'file was successful added!');
                $photo = new exbiofiles;
                $photo->idexbio = $examenbio->id;
                $photo->downloads =  $examenbio->dossier . "-" . time() . "-" . $img->getClientOriginalName();
                $photo->save();
            }
        }
        return  redirect('administrateur/dossiers/examenbios/show/' . $examenbio->id);
    }

    public function showExamenfiles($idC)
    {
        $examenbio = Examenbio::FindOrFail($idC);
        $dossier = Dossier::findorfail($examenbio->dossier);
        $files = Exbiofiles::where('idexbio', '=', $idC)->get();
        return view('administrateur.dossiers.examenbios.files', [
            'files' => $files,
            'dossier' => $dossier
        ]);
    }

    public function deleteFile($id)
    {
        $file = Exbiofiles::findorfail($id);
        unlink(public_path('uploads/exbio/' . $file->downloads));
        Exbiofiles::destroy($id);
        return Redirect::back();
    }

    public function getDefaultUrl(Request $request)
    {
        $url = User::where("id", $request->id_medecin)->pluck("url_bio");
        return response()->json($url);
    }
}
