<?php

namespace App\Http\Controllers\administrateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Dossier;
use App\Models\Examenradio;
use App\Models\Exradiofiles;
use App\Models\User;
use App\Models\Radio;
use File;
use ZipArchive;

class examenradioController extends Controller
{
    public function index($id_dossier)
    {
        $liste_examenradios = Examenradio::with('files', 'medecin')
            ->where('dossier', '=', $id_dossier)
            ->orderBy('date', 'desc')
            ->get();

        $dossier = Dossier::findorfail($id_dossier);

        return view('administrateur.dossiers.examenradios.index', compact('liste_examenradios', 'dossier'));
    }

    public function show($idC)
    {
        $examenradio = Examenradio::with('files', 'medecin', 'typeradio', 'Radio', 'createdBy')
            ->findOrFail($idC);

        $dossier = Dossier::findorfail($examenradio->dossier);
        return view('administrateur.dossiers.examenradios.show', compact('dossier', 'examenradio'));
    }

    public function create($id_dossier)
    {
        $dossier = Dossier::findorfail($id_dossier);
        return view('administrateur.dossiers.examenradios.create', ['dossier' => $dossier]);
    }

    public function store(Request $request)
    {
        $examenradio = new Examenradio();
        if (($request->input('option')) == 'Autres') {
            $examenradio->url_radio = $request->input('url_radio');
        } else {
            $examenradio->url_radio = $request->input('option');
        }
        //  $examenradio->radio = $request->input('state');
        $examenradio->radio2 = $request->input('nv_ex');
        $examenradio->fill($request->only($examenradio->getfillable()));
        $examenradio->save();

        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $img->move('uploads/exradio/', $examenradio->dossier . "-" . time() . "-" . $img->getClientOriginalName());
                $photo = new Exradiofiles;
                $photo->idexradio = $examenradio->id;
                $photo->downloads = $examenradio->dossier . "-" . time() . "-" . $img->getClientOriginalName();;
                $photo->save();
            }
        }

        if ($target = $request->file('target')) {
            $zip = new ZipArchive;
            $x = mt_rand(1000, 9999);
            $fileName =  $examenradio->id . '-' . $x . '.zip';
            File::makeDirectory(public_path() . '/uploads/tmpFiles' . $x);
            foreach ($target as $t) {

                $t->move('uploads/tmpFiles' . $x . '/', $t->getClientOriginalName());
            }
            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                $files = File::files('uploads/tmpFiles' . $x);
                foreach ($files as $key => $value) {
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
                $zip->close();
            }
            foreach ($target as $t) {
                File::deleteDirectory(public_path('uploads/tmpFiles' . $x));
            }
        }
        $examenradio->save();

        return  redirect('administrateur/dossiers/examenradios/show/' . $examenradio->id);
    }

    public function edit($idC)
    {
        $examenradio = Examenradio::with('files', 'medecin', 'typeradio', 'Radio')
            ->findorFail($idC);
        $dossier = Dossier::findorfail($examenradio->dossier);
        return view('administrateur.dossiers.examenradios.edit', compact('dossier', 'examenradio'));
    }

    public function update(Request $request, $idC)
    {
        $examenradio = ExamenRadio::FindOrFail($idC);
        $examenradio->date = $request->input('date');
        $examenradio->id_medecin = $request->input('id_medecin');
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
                $img->move('uploads/exradio/', $examenradio->dossier . "-" . time() . "-" . $img->getClientOriginalName());
                $photo = new exradiofiles;
                $photo->idexradio = $examenradio->id;
                $photo->downloads = $examenradio->dossier . "-" . time() . "-" . $img->getClientOriginalName();
                $photo->save();
            }
        }
        return  redirect('administrateur/dossiers/examenradios/show/' . $examenradio->id);
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

    public function showExamenfiles($id)
    {
        $examenradio = Examenradio::FindOrFail($id);
        $dossier = Dossier::findorFail($examenradio->dossier);
        $files = Exradiofiles::where('idexradio', '=', $id)->get();
        return view('administrateur.dossiers.examenradios.files', [
            'files' => $files,
            'dossier' => $dossier
        ]);
    }

    public function getDefaultUrlPacs(Request $request)
    {
        $url = User::where("id", $request->id_medecin)->pluck("url_pacs");
        return response()->json($url);
    }

    public function downloadZip()
    {
        $zip = new ZipArchive;
        $fileName = 'myNewFile.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            $files = File::files(public_path('myFiles'));
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        }
        return response()->download(public_path($fileName));
    }

    public function getStateList(Request $request)
    {
        $states = Radio::where("typeradio", $request->type_radio)->pluck("lib", "id");
        return response()->json($states);
    }
}
