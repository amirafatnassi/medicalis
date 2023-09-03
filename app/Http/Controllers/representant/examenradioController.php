<?php

namespace App\Http\Controllers\representant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Dossier;
use App\Models\Examenradio;
use App\Models\Exradiofiles;

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
        return view('representant.dossiers.examenradios.index', [
            'liste_examenradios' => $liste_examenradios,
            'dossier' => $dossier
        ]);
    }
    
    public function show($idC)
    {
        $files = DB::select(DB::raw('select * from exradiofiles where idexradio=' . $idC));
        $examenradio = DB::select(DB::raw('SELECT distinct(c.id),
        exradiofiles.downloads,
        c.date,
        concat(med.prenom," ",med.nom) as med, c.id_medecin,
        concat(u.prenom," ", u.nom) as user, c.created_by,
        s.lib as specialite,
        c.dossier,
        radiotypes.lib as type_radio,
        c.url_radio,
        radios.lib as radio,
        c.radio2,
        c.lettre,
        c.imagerie,
        c.remarques,
        c.created_at,
        c.updated_at
        FROM examenradios as c
        left join users as u on c.created_by=u.id
        left join medecins as med on med.id=c.id_medecin
        left join exradiofiles on exradiofiles.idexradio=c.id
        left join radiotypes on radiotypes.id=c.type_radio
        left join radios on radios.id=c.radio
        left join specialites as s on s.id=med.specialite
        where c.id=' . $idC));

        $dossier = DB::select(DB::raw('SELECT *
        FROM dossiers where id="' . $examenradio[0]->dossier . '"'));

        return view('representant.dossiers.examenradios.show', [
            'dossier' => $dossier,
            'examenradio' => $examenradio,
            'files' => $files
        ]);
    }
    public function create($id_dossier)
    {
        $dossier = DB::select(DB::raw('SELECT *
        FROM dossiers where id="' . $id_dossier . '"'));

        $liste_meds = DB::select(DB::raw('select * from medecins'));

        $typesRadios = DB::table("radiotypes")->pluck("lib", "id");
        return view('representant.dossiers.examenradios.create', [
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
        }
        $examenradio->imagerie = $fileName;
        $examenradio->save();

        return  redirect('/representant/dossiers/examenradios/show/' . $examenradio->id);
    }

    public function edit($idC)
    {
        $typesRadios = DB::table("radiotypes")->pluck("lib", "id");
        $liste_meds = DB::select(DB::raw('select * from medecins'));

        $files = DB::select(DB::raw('select * from exradiofiles where idexradio=' . $idC));
        $examenradio = DB::select(DB::raw('SELECT distinct(c.id),
        exradiofiles.downloads,c.date,
        concat(med.prenom," ",med.nom) as med, c.id_medecin,
        c.type_radio as modalite_id,
         radiotypes.lib as modalite_lib, 
         c.dossier,
         radiotypes.lib as type_radio,
         c.url_radio,
         c.radio as radio_id ,
         radios.lib as radio,
         c.radio2,
         c.lettre,
         c.remarques,
         c.created_at,
         c.updated_at
        FROM examenradios as c
        left join medecins as med on c.id_medecin=med.id
        left join exradiofiles on exradiofiles.idexradio=c.id
        left join radiotypes on radiotypes.id=c.type_radio
        left join radios on radios.id=c.radio
        where c.id=' . $idC . '
        group by c.id,exradiofiles.idexradio,exradiofiles.downloads,c.radio,c.date,
        c.id_medecin,
        med.nom,
        med.prenom,c.type_radio,c.dossier,
        c.url_radio,radiotypes.lib,radios.lib,c.radio2,c.lettre,c.remarques,c.created_at,c.updated_at'));

        $dossier = Dossier::where('id', '=', $examenradio[0]->dossier)->firstOrFail();

        return view('representant.dossiers.examenradios.edit', [
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
        return  redirect('/representant/dossiers/examenradios/show/' . $examenradio->id);
    }
    public function getStateList(Request $request)
    {
        $states = DB::table("radios")->where("typeradio", $request->typeradio)->pluck("lib", "id");
        return response()->json($states);
    }

    public function getRadios(Request $request)
    {dd('tetette');
        $states = DB::table("radios")->where("typeradio", $request->typeradio)->pluck("lib", "id");
        return response()->json($states);
    }


    public function getMedList(Request $request)
    {
        $states = DB::table("medecins")->where("specialite", $request->specialite)->pluck("nom", "id");
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

        $dossier = DB::select(DB::raw('SELECT *
        FROM dossiers where id="' . $examenradio->dossier . '"'));

        $files = DB::select(DB::raw('select * from exradiofiles where idexradio=' . $id));
        return view('representant.dossiers.examenradios.files', ['files' => $files, 'dossier' => $dossier]);
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
