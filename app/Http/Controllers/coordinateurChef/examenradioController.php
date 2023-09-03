<?php

namespace App\Http\Controllers\coordinateurChef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Dossier;
use App\Models\Examenradio;
use App\Models\Exradiofiles;
use App\Models\Medecin;

use File;
use ZipArchive;

class examenradioController extends Controller
{
    public function index($id_dossier)
    {
        $liste_examenradios = Examenradio::select(
            'examenradios.id',
            DB::raw("count(exradiofiles.downloads) as downloads"),
            'examenradios.date',
            DB::raw("concat(med.prenom,' ',med.nom) as med"),
            'examenradios.id_medecin',
            DB::raw("concat(u.prenom,' ',u.nom) as user"),
            'examenradios.created_by',
            'examenradios.dossier',
            'url_radio',
            'examenradios.remarques',
            's.lib as specialite'
        )
            ->leftJoin('users as u', 'examenradios.created_by', '=', 'u.id')
            ->leftJoin('medecins as med', 'med.id', '=', 'examenradios.id_medecin')
            ->leftJoin('exradiofiles', 'exradiofiles.idexradio', '=', 'examenradios.id')
            ->leftJoin('specialites as s', 'med.specialite', '=', 's.id')
            ->where('examenradios.dossier', '=', $id_dossier)
            ->groupBy(
                'examenradios.id',
                'examenradios.date',
                'examenradios.id_medecin',
                'u.nom',
                'u.prenom',
                'med.prenom',
                'med.nom',
                'examenradios.created_by',
                'examenradios.dossier',
                'url_radio',
                'examenradios.remarques',
                's.lib'
            )
            ->orderBy('examenradios.date', 'DESC')->get();
        $dossier = Dossier::findorfail($id_dossier);
        return view('coordinateurChef.dossiers.examenradios.index', [
            'liste_examenradios' => $liste_examenradios,
            'dossier' => $dossier
        ]);
    }
    public function show($idC)
    {
        $files = Exradiofiles::where('idexradio', '=', $idC)->get();
        $examenradio = Examenradio::select(
            'examenradios.id',
            DB::raw("count(exradiofiles.downloads)"),
            'examenradios.date',
            DB::raw("concat(med.prenom,' ',med.nom) as medecin"),
            'examenradios.id_medecin',
            DB::raw("concat(u.prenom,' ', u.nom) as user"),
            'examenradios.created_by',
            's.lib as specialite',
            'examenradios.dossier',
            'radiotypes.lib as type_radio',
            'examenradios.url_radio',
            'radios.lib as radio',
            'examenradios.radio2',
            'examenradios.lettre',
            'examenradios.imagerie',
            'examenradios.remarques',
            'examenradios.created_at',
            'examenradios.updated_at'
        )
            ->leftJoin('users as u', 'examenradios.created_by', '=', 'u.id')
            ->leftJoin('medecins as med', 'med.id', '=', 'examenradios.id_medecin')
            ->leftJoin('exradiofiles', 'exradiofiles.idexradio', '=', 'examenradios.id')
            ->leftJoin('radiotypes', 'radiotypes.id', '=', 'examenradios.type_radio')
            ->leftJoin('radios', 'radios.id', '=', 'examenradios.radio')
            ->leftJoin('specialites as s', 's.id', '=', 'med.specialite')
            ->where('examenradios.id', '=', $idC)
            ->groupBy(
                'examenradios.id',
                'examenradios.date',
                'med.prenom',
                'med.nom',
                'examenradios.id_medecin',
                'u.prenom',
                'u.nom',
                'examenradios.created_by',
                's.lib',
                'examenradios.dossier',
                'radiotypes.lib',
                'examenradios.url_radio',
                'radios.lib',
                'examenradios.radio2',
                'examenradios.lettre',
                'examenradios.imagerie',
                'examenradios.remarques',
                'examenradios.created_at',
                'examenradios.updated_at'
            )->first();
        $dossier = Dossier::findorfail($examenradio->dossier);
        return view('coordinateurChef.dossiers.examenradios.show', [
            'dossier' => $dossier,
            'examenradio' => $examenradio,
            'files' => $files
        ]);
    }
    public function create($id_dossier)
    {
        $dossier = Dossier::findorfail($id_dossier);
        $liste_meds = Medecin::all();
        $typesRadios = DB::table("radiotypes")->pluck("lib", "id");
        return view('coordinateurChef.dossiers.examenradios.create', [
            'dossier' => $dossier,
            'liste_meds' => $liste_meds,
            'countries' => $typesRadios,
        ]);
    }
    public function store(Request $request)
    {
        $examenradio = new Examenradio();
        $examenradio->date = $request->input('date');
        $examenradio->id_medecin = $request->input('id_medecin');
        $examenradio->created_by = Auth::user()->id;
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
            File::move(public_path('/' . $fileName), public_path('uploads/imagerie/' . $fileName));
            $examenradio->imagerie = $fileName;
            $examenradio->save();
        }

        return  redirect('/coordinateurChef/dossiers/examenradios/show/' . $examenradio->id);
    }

    public function edit($idC)
    {
        $typesRadios = DB::table("radiotypes")->pluck("lib", "id");
        $liste_meds = Medecin::all();
        $files = Exradiofiles::where('idexradio', '=', $idC)->get();
        $examenradio = Examenradio::select(
            'c.id',
            DB::raw("count('exradiofiles.downloads')"),
            'c.date',
            DB::raw("concat(med.prenom,' ',med.nom) as medecin"),
            'c.id_medecin',
            'c.type_radio as modalite_id',
            'radiotypes.lib as modalite_lib',
            'c.dossier',
            'radiotypes.lib as type_radio',
            'c.url_radio',
            'c.radio as radio_id',
            'radios.lib as radio',
            'c.radio2',
            'c.lettre',
            'c.remarques',
            'c.created_at',
            'c.updated_at'
        )
            ->leftJoin('medecins as med', 'c.id_medecin', '=', 'med.id')
            ->leftJoin('exradiofiles', 'exradiofiles.idexradio', '=', 'c.id')
            ->leftJoin('radiotypes', 'radiotypes.id', '=', 'c.type_radio')
            ->leftJoin('radios', 'radios.id', '=', 'c.radio')
            ->where('c.id', '=', $idC)
            ->groupBy(
                'c.id',
                'exradiofiles.idexradio',
                'c.radio',
                'c.date',
                'c.id_medecin',
                'med.nom',
                'med.prenom',
                'c.type_radio',
                'c.dossier',
                'c.url_radio',
                'radiotypes.lib',
                'radios.lib',
                'c.radio2',
                'c.lettre',
                'c.remarques',
                'c.created_at',
                'c.updated_at'
            )
            ->first();
        $dossier = Dossier::findorfail($examenradio->dossier);
        return view('coordinateurChef.dossiers.examenradios.edit', [
            'dossier' => $dossier,
            'liste_meds' => $liste_meds,
            'typesRadios' => $typesRadios,
            'examenradio' => $examenradio,
            'files' => $files
        ]);
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
        return  redirect('/coordinateurChef/dossiers/examenradios/show/' . $examenradio->id);
    }
    public function getStateList(Request $request)
    {
        $states = DB::table("radios")->where("typeradio", $request->typeradio)->pluck("lib", "id");
        return response()->json($states);
    }
    public function deleteFile($id)
    {
        $file = DB::select(DB::raw('select * from exradiofiles where id=' . $id));
        unlink(public_path('../uploads/exradio/' . $file[0]->downloads));
        DB::delete('delete from exradiofiles where id=' . $id);
        return Redirect::back();
    }

    public function showExamenfiles($id)
    {
        $examenradio = Examenradio::FindOrFail($id);
        $dossier = Dossier::findorfail($examenradio->dossier);
        $files = Exradiofiles::where('idexradio', '=', $id);
        return view('coordinateurChef.dossiers.examenradios.files', ['files' => $files, 'dossier' => $dossier]);
    }

    public function getDefaultUrlPacs(Request $request)
    {
        $url = DB::table("medecins")->where("id", $request->id_medecin)->pluck("url_pacs");
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
}
