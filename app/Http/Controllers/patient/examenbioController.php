<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\Examenbio;
use App\Models\Exbiofiles;
use Auth;

class examenbioController extends Controller
{
    public function index()
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $liste_examenbios = Examenbio::with('files','medecin')
            ->where('dossier', $dossier->id)
            ->get();
        return view('patient.dossiers.examenbios.index', compact('dossier','liste_examenbios'));
    }

    public function show($id)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $examenbio = Examenbio::with('files')
            ->where('dossier', '=', $dossier->id)
            ->findorFail($id);

        return view('patient.dossiers.examenbios.show', compact('dossier','examenbio'));
    }

    public function edit($id)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $examenbio = Examenbio::with('files')
            ->where('dossier', '=', $dossier->id)
            ->findorFail($id);
        return view('patient.dossiers.examenbios.edit', compact('dossier','examenbio'));
    }

    public function update(Request $request, $id)
    {
        $examenbio = Examenbio::FindOrFail($id);
        $examenbio->date = $request->input('date');
        $examenbio->lettre = $request->input('lettre');
        $examenbio->save();
        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $profileImage = $examenbio->dossier . "-" . time() . "-" . $img->getClientOriginalName();
                $img->move('uploads/exbio/', $profileImage);
                $photo = new exbiofiles;
                $photo->idexbio = $examenbio->id;
                $photo->downloads = $profileImage;
                $photo->save();
            }
        }
        return redirect('/patient/examenbios/' . $id . '/show');
    }

    public function showExamenbioFiles($id)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $files = Exbiofiles::where('idexbio', '=', $id)->get();
        return view('patient.dossiers.examenbios.files', compact('dossier','files'));
    }

    public function deleteFile($id)
    {
        $file = Exbiofiles::findorFail($id);
        if ($file) {
            unlink('uploads/exbio/' .  $file->downloads);
            $file->delete();
        }
        return redirect()->back();
    }

    public function create()
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        return view('patient.dossiers.examenbios.create',compact('dossier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lettre' => 'required',
        ]);
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $examenbio = new Examenbio();
        if (($request->input('url')) == 'Autres') {
            $examenbio->url_bio = $request->input('url_bio');
        } else {
            $examenbio->url_bio = $request->input('url');
        }
        $examenbio->dossier = $dossier->id;
        $examenbio->remarques = "saisie par le patient !";
        $examenbio->fill($request->only($examenbio->getfillable()));
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
        return redirect('/patient/examenbios/' . $examenbio->id . '/show');
    }

    public function urlBio($id)
    {
        $exbio = Examenbio::findorFail($id);
        return redirect()->away('http://' . $exbio->url_bio . '/');
    }
}
