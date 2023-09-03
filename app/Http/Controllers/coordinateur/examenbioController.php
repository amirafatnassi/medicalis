<?php

namespace App\Http\Controllers\coordinateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Examenbio;
use App\Models\Dossier;
use App\Models\Exbiofiles;
use App\Models\Medecin;

class examenbioController extends Controller
{
    public function index($id_dossier)
    {
        $liste_examenbios = Examenbio::with('files', 'medecin')
            ->where('dossier', $id_dossier)
            ->get();
        $dossier = Dossier::findorFail($id_dossier);
        return view('coordinateur.dossiers.examenbios.index', compact('dossier', 'liste_examenbios'));
    }

    public function create($id_dossier)
    {
        $dossier = Dossier::findorfail($id_dossier);
        return view('coordinateur.dossiers.examenbios.create', [
            'dossier' => $dossier,
        ]);
    }

    public function edit($idC)
    {
        $files = Exbiofiles::where('idexbio', '=', $idC)->get();
        $examenbio = Examenbio::select(
            'examenbios.id',
            DB::raw("count(exbiofiles.downloads)"),
            'examenbios.date',
            DB::raw("concat(u.prenom,' ',u.nom) as user"),
            'examenbios.created_by',
            DB::raw("concat(med.prenom,' ',med.nom) as medecin"),
            'examenbios.id_medecin',
            'examenbios.remarques',
            'examenbios.dossier',
            'examenbios.lettre',
            'examenbios.url_bio',
            'examenbios.created_at',
            'examenbios.updated_at'
        )
            ->leftJoin('users as u', 'examenbios.created_by', '=', 'u.id')
            ->leftJoin('medecins as med', 'examenbios.id_medecin', '=', 'med.id')
            ->leftJoin('exbiofiles', 'exbiofiles.idexbio', '=', 'examenbios.id')
            ->where('examenbios.id', '=', $idC)
            ->groupBy(
                'examenbios.id',
                'examenbios.date',
                'u.prenom',
                'u.nom',
                'examenbios.created_by',
                'med.prenom',
                'med.nom',
                'examenbios.id_medecin',
                'examenbios.remarques',
                'examenbios.dossier',
                'examenbios.lettre',
                'examenbios.url_bio',
                'examenbios.created_at',
                'examenbios.updated_at'
            )
            ->first();
        $dossier = Dossier::findorfail($examenbio->dossier);
        return view('coordinateur.dossiers.examenbios.edit', [
            'dossier' => $dossier,
            'examenbio' => $examenbio,
            'files' => $files,
        ]);
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
        return  redirect('/coordinateur/dossiers/examenbios/show/' . $id);
    }

    public function show($idC)
    {
        $examenbio = Examenbio::with('files', 'medecin')->findorFail($idC);
        $dossier = Dossier::findorFail($examenbio->dossier);
        return view('coordinateur.dossiers.examenbios.show', compact('dossier', 'examenbio'));
    }

    public function store(Request $request)
    {
        $examenbio = new Examenbio();
        $examenbio->id_medecin = $request->input('id_medecin');
        $examenbio->created_by = Auth::user()->id;
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
                $img->move('uploads/exbio/', $examenbio->dossier . "-" . time() . "-" . $img->getClientOriginalName());
                $request->session()->flash('alert-success', 'file was successful added!');
                $photo = new exbiofiles;
                $photo->idexbio = $examenbio->id;
                $photo->downloads =  $examenbio->dossier . "-" . time() . "-" . $img->getClientOriginalName();
                $photo->save();
            }
        }
        return redirect('coordinateur/dossiers/examenbios/show/' . $examenbio->id);
    }

    public function showExamenfiles($idC)
    {
        $examenbio = Examenbio::FindOrFail($idC);
        $dossier = Dossier::finsorfail($examenbio->dossier);
        $files = Exbiofiles::where('idexbio', '=', $idC)->get();
        return view('coordinateur.dossiers.examenbios.files', [
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
        $url = Medecin::where("id", $request->id_medecin)->pluck("url_bio");
        return response()->json($url);
    }
}
