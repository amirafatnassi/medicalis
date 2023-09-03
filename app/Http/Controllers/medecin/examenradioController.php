<?php

namespace App\Http\Controllers\medecin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Dossier;
use App\Models\Examenradio;
use App\Models\Exradiofiles;
use Auth;

class examenradioController extends Controller
{
    public function index($id_dossier)
    {
        $liste_examenradios = Examenradio::with('medecin', 'Dossier')
            ->where('dossier', '=', $id_dossier)->get();
        $dossier = Dossier::findorFail($id_dossier);
        return view('medecin.examenradios.index', compact('liste_examenradios', 'dossier'));
    }

    public function show($idC)
    {
        $examenradio = Examenradio::with('files', 'createdBy', 'typeradio', 'Radio', 'medecin', 'Dossier')
            ->where('id', '=', $idC)
            ->firstorFail();
        $dossier = $examenradio->Dossier;
        return view('medecin.examenradios.show', compact('dossier', 'examenradio'));
    }

    public function create($id_dossier)
    {
        $dossier = Dossier::findorFail($id_dossier);
        return view('medecin.examenradios.create', compact('dossier'));
    }

    public function store(Request $request)
    {
        $examenradio = new Examenradio();
        $examenradio->date = $request->input('date');
        $examenradio->id_medecin = Auth::user()->id;
        if (($request->input('option')) == 'Autres') {
            $examenradio->url_radio = $request->input('url_radio');
        } else {
            $examenradio->url_radio = $request->input('option');
        }
        $examenradio->type_radio = $request->input('typeradio');
        $examenradio->radio = $request->input('state');
        $examenradio->radio2 = $request->input('nv_ex');
        $examenradio->lettre = $request->input('lettre');
        $examenradio->dossier = $request->input('dossier');
        $examenradio->save();
        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $profileImage = "$examenradio->dossier" . "-" . time() . "-" . $img->getClientOriginalName();
                $img->move(public_path('uploads/exradio/'), $profileImage);
                $photo = new exradiofiles;
                $photo->idexradio = $examenradio->id;
                $photo->downloads = "$profileImage";
                $photo->save();
            }
        }
        return  redirect('/medecin/examenradio/' . $examenradio->id . '/show');
    }

    public function edit($idC)
    {
        $examenradio = Examenradio::with('files', 'createdBy', 'typeradio', 'Radio', 'medecin', 'Dossier')
            ->findorFail($idC);
        $dossier = Dossier::findorFail($examenradio->dossier);
        return view('medecin.examenradios.edit', compact('dossier', 'examenradio'));
    }

    public function update(Request $request, $idC)
    {
        $examenradio = ExamenRadio::FindOrFail($idC);
        $examenradio->date = $request->input('date');
        if (($request->input('option')) == 'Autres') {
            $examenradio->url_radio = $request->input('url_radio');
        } else {
            $examenradio->url_radio = $request->input('option');
        }
        $examenradio->type_radio = $request->input('typeradio');
        $examenradio->radio = $request->input('state');
        $examenradio->radio2 = $request->input('nv_ex');
        $examenradio->lettre = $request->input('lettre');
        $examenradio->save();
        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $profileImage = "$examenradio->dossier" . "-" . time() . "-" . $img->getClientOriginalName();
                $img->move(public_path('uploads/exradio/'), $profileImage);
                $photo = new exradiofiles;
                $photo->idexradio = $examenradio->id;
                $photo->downloads = "$profileImage";
                $photo->save();
            }
        }
        return  redirect('/medecin/examenradio/' . $examenradio->id . '/show');
    }

    public function deleteFile($id)
    {
        $file = Exradiofiles::findorfail($id);
        if ($file) {
            unlink(public_path('uploads/exradio/' . $file->downloads));
            $file->delete();
        }
        return Redirect::back();
    }

    public function showExamenfiles($id)
    {
        $exradio = Examenradio::findorFail($id);
        $dossier = Dossier::findorFail($exradio->dossier);
        $files = Exradiofiles:: where('idexradio',$id)->get();
        return view('medecin.examenradios.files', compact('dossier', 'files'));
    }

    public function urlRadio($id)
    {
        $r = Examenradio::findorFail($id);
        return redirect()->away('http://' . $r->url_radio . '/');
    }
}
