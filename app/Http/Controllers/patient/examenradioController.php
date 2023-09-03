<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Examenradio;
use App\Models\Exradiofiles;
use App\Models\Dossier;
use Auth;

class examenradioController extends Controller
{
    public function index()
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $liste_examenradios = Examenradio::with('files')
            ->where('dossier', $dossier->id)
            ->get();
        return view('patient.dossiers.examenradios.index', compact('dossier','liste_examenradios'));
    }

    public function show($idC)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $examenradio = Examenradio::with('files', 'typeradio', 'Radio')
            ->where('dossier', $dossier->id)
            ->findorFail($idC);

        return view('patient.dossiers.examenradios.show', compact('dossier','examenradio'));
    }

    public function create()
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        return view('patient.dossiers.examenradios.create',compact('dossier'));
    }

    public function store(Request $request)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $examenradio = new Examenradio();
        $examenradio->date = $request->input('date');
        $examenradio->url_radio = $request->input('url_radio');
        $examenradio->type_radio = $request->input('typeradio');
        $examenradio->radio = $request->input('state');
        $examenradio->lettre = $request->input('lettre');
        $examenradio->remarques = "saisie par le patient !";
        $examenradio->dossier = $dossier->id;
        $examenradio->save();
        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $profileImage =  $examenradio->dossier . "-" . time() . "-" . $img->getClientOriginalName();
                $img->move('uploads/exradio', $profileImage);
                $photo = new exradiofiles;
                $photo->idexradio = $examenradio->id;
                $photo->downloads = $profileImage;
                $photo->save();
            }
        }
        return redirect('patient/examenradios/' . $examenradio->id . '/show');
    }

    public function edit($idC)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $examenradio = Examenradio::with('files', 'Radio', 'typeradio')
            ->where('dossier', $dossier->id)
            ->findorFail($idC);
        return view('patient.dossiers.examenradios.edit', compact('dossier','examenradio'));
    }

    public function update(Request $request, $id)
    {
        $examenradio = ExamenRadio::FindOrFail($id);
        $examenradio->date = $request->input('date');
        $examenradio->url_radio = $request->input('url_radio');
        $examenradio->type_radio = $request->input('typeradio');
        $examenradio->radio = $request->input('state');
        $examenradio->lettre = $request->input('lettre');
        $examenradio->remarques = "saisie par le patient !";
        $examenradio->save();
        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $profileImage = Auth::user('patient')->id . "-" . time() . "-" . $img->getClientOriginalName();
                $img->move('uploads/exradio/', $profileImage);
                $photo = new exradiofiles;
                $photo->idexradio = $examenradio->id;
                $photo->downloads = "$profileImage";
                $photo->save();
            }
        }
        return redirect('patient/dossiers/examenradios/' . $id . '/show');
    }

    public function showExamenradioFiles($id)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $files = Exradiofiles::where('idexradio', $id)->get();
        return view('patient.dossiers.examenradios.files', compact('dossier','files'));
    }

    public function urlRadio($id)
    {
        $url = Examenradio::findorFail($id);
        return redirect()->away('http://' . $url->url_radio . '/');
    }

    public function deleteFile($id)
    {
        $file = Exradiofiles::findorFail($id);
        if ($file) {
            unlink(public_path('../uploads/exradio/' . $file->downloads));
            $file->delete();
        }
        return Redirect::back();
    }
}
