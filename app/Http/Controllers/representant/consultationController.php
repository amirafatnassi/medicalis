<?php

namespace App\Http\Controllers\representant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Dossier;
use App\Models\Consultation;
use App\Models\Consultationfiles;
use App\Models\Motif;
use App\Models\Medecin;

class consultationController extends Controller
{
    public function index($id_dossier)
    {
        $dossier = Dossier::findorfail($id_dossier);
        $liste_consultations = Consultation::select(
            'consultations.id',
            DB::raw("count(consultationfiles.downloads) as downloads"),
            'date',
            'motifs.lib as motif',
            'observation',
            DB::raw("concat(medecins.nom,' ',medecins.prenom) as medecin"),
            DB::raw("concat(users.nom,' ',users.prenom) as user"),
            'remarques',
            'specialites.lib as specialite'
        )
            ->leftJoin('motifs', 'motif', '=', 'motifs.id')
            ->leftJoin('consultationfiles', 'consultationfiles.idConsultation', '=', 'consultations.id')
            ->leftJoin('dossier_users', 'dossier_users.dossier_id', '=', 'id_dossier')
            ->leftJoin('medecins', 'id_medecin', '=', 'medecins.id')
            ->leftJoin('users', 'created_by', '=', 'users.id')
            ->leftJoin('specialites', 'medecins.specialite', '=', 'specialites.id')
            ->WHERE('id_dossier', '=', $id_dossier)
            ->groupBy(
                'consultations.id',
                'date',
                'motifs.lib',
                'observation',
                'medecins.nom',
                'medecins.prenom',
                'users.nom',
                'users.prenom',
                'remarques',
                'specialites.lib'
            )
            ->orderBy('date', 'DESC')
            ->get();

        return view('representant.dossiers.consultations.index', [
            'dossier' => $dossier,
            'liste_consultations' => $liste_consultations
        ]);
    }

    public function create($id_dossier)
    {
        $dossier = Dossier::findorfail($id_dossier)->first();
        $liste_motif = Motif::all();
        $liste_meds = Medecin::all();
        return view('representant.dossiers.consultations.create', [
            'liste_motif' => $liste_motif,
            'liste_meds' => $liste_meds,
            'dossier' => $dossier
        ]);
    }
    public function edit($idC)
    {
        $liste_motif = Motif::all();
        $liste_meds = Medecin::all();
        $files = Consultationfiles::where('idConsultation', '=', $idC)->get();
        $consultation = Consultation::select(
            'consultations.id',
            DB::raw("count('consultationfiles.downloads')"),
            'consultations.date',
            'm.lib as motif',
            'consultations.motif as id_motif',
            'consultations.poids',
            'consultations.taille',
            'consultations.ta',
            'consultations.observation',
            'consultations.observation_prive',
            'consultations.effet_marquant',
            'consultations.remarques',
            'consultations.effet_marquant_txt',
            DB::raw("concat( med.prenom ,' ', med.nom) as med"),
            'id_medecin',
            DB::raw("concat( u.prenom ,' ', u.nom) as user"),
            'consultations.created_by',
            'consultations.id_dossier',
            'consultations.created_at',
            'consultations.updated_at'
        )
            ->leftJoin('motifs as m', 'consultations.motif', '=', 'm.id')
            ->leftJoin('consultationfiles', 'consultationfiles.idConsultation', '=', 'consultations.id')
            ->leftJoin('medecins as med', 'med.id', '=', 'consultations.id_medecin')
            ->leftJoin('users as u', 'u.id', '=', 'consultations.created_by')
            ->WHERE('consultations.id', '=', $idC)
            ->groupBy(
                'consultations.id',
                'consultations.date',
                'm.lib',
                'consultations.motif',
                'consultations.poids',
                'consultations.taille',
                'consultations.ta',
                'consultations.observation',
                'consultations.observation_prive',
                'consultations.effet_marquant',
                'consultations.remarques',
                'consultations.effet_marquant_txt',
                'med.prenom',
                'med.nom',
                'id_medecin',
                'u.prenom',
                'u.nom',
                'consultations.created_by',
                'consultations.id_dossier',
                'consultations.created_at',
                'consultations.updated_at'
            )->first();
       $dossier = Dossier::findorfail($consultation->id_dossier)->first();
        return view('representant.dossiers.consultations.edit', [
            'liste_motif' => $liste_motif,
            'liste_meds' => $liste_meds,
            'consultation' => $consultation,
            'files' => $files,
            'dossier' => $dossier
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->has('effet_marquant')) {
            $effet = 1;
        } else {
            $effet = 0;
        }
        $c = Consultation::FindOrFail($id);
        $c->date = $request->input('date');
        $c->id_medecin =  $request->input('id_medecin');
        $c->motif = $request->input('motif');
        $c->taille = $request->input('taille');
        $c->poids = $request->input('poids');
        $c->ta = $request->input('ta');
        $c->observation = $request->input('observation');
        $c->observation_prive = $request->input('observation_prive');
        $c->effet_marquant = $effet;
        $c->effet_marquant_txt = $request->input('effet_marquant_txt');
        if ($files = $request->file('filesup')) {
            foreach ($files as $img) {
                $img->move('uploads/consultation/', $c->id_dossier . "-" . time() . "-" . $img->getClientOriginalName());
                $photo = new Consultationfiles;
                $photo->idConsultation = $c->id;
                $photo->downloads = $c->id_dossier . "-" . time() . "-" . $img->getClientOriginalName();
                $photo->save();
            }
        }
        $c->save();
        return  redirect('/representant/dossiers/consultations/show/' . $id);
    }

    public function deleteFile($id)
    {
        $file = DB::select(DB::raw('select * from consultationfiles where id=' . $id));
        unlink(public_path('../public/uploads/consultation/' . $file[0]->downloads));
        DB::delete('delete from consultationfiles where id=' . $id);
        return Redirect::back();
    }

    public function show($idC)
    {
        $files = Consultationfiles::where('idConsultation', '=', $idC)->get();
        $consultation = Consultation::select(
            'consultations.id',
            DB::raw("count(consultationfiles.downloads) as downloads"),
            'consultations.date',
            'm.lib as motif',
            'consultations.poids',
            'consultations.taille',
            'consultations.ta',
            'consultations.observation',
            'consultations.observation_prive',
            'consultations.effet_marquant',
            'consultations.remarques',
            'consultations.effet_marquant_txt',
            DB::raw("concat( med.prenom ,' ', med.nom) as med"),
            'consultations.id_medecin',
            DB::raw("concat( u.prenom ,' ', u.nom) as user"),
            'consultations.id_dossier',
            's.lib as specialite',
            'consultations.created_by',
            'consultations.created_at',
            'consultations.updated_at'
        )
            ->leftJoin('motifs as m', 'consultations.motif', '=', 'm.id')
            ->leftJoin('consultationfiles', 'consultationfiles.idConsultation', '=', 'consultations.id')
            ->leftJoin('medecins as med', 'med.id', '=', 'consultations.id_medecin')
            ->leftJoin('specialites as s', 's.id', '=', 'med.specialite')
            ->leftJoin('users as u', 'u.id', '=', 'consultations.created_by')
            ->WHERE('consultations.id', '=', $idC)
            ->groupBy(
                'consultations.id',
                'consultations.date',
                'm.lib',
                'consultations.poids',
                'consultations.taille',
                'consultations.ta',
                'consultations.observation',
                'consultations.observation_prive',
                'consultations.effet_marquant',
                'consultations.remarques',
                'consultations.effet_marquant_txt',
                'med.nom',
                'med.prenom',
                'u.prenom',
                'u.nom',
                's.lib',
                'id_medecin',
                'consultations.id_dossier',
                'consultations.created_by',
                'consultations.created_at',
                'consultations.updated_at'
            )->first();
        $dossier = Dossier::findorfail($consultation->id_dossier);
        return view('representant.dossiers.consultations.show', [
            'consultation' => $consultation,
            'dossier' => $dossier,
            'files' => $files
        ]);
    }

    public function imprimer($id_dossier, $idC)
    {
        $data = DB::select(DB::raw('SELECT d.id,
        concat(d.nom," ",d.prenom) as id_patient,b.lib as groupe_sanguin,d.taille,d.sexe,d.poids,d.datenaissance,d.lieunaissance,
        d.tel,d.email,d.profession,
        d.contactdurgence,d.pays,v.name as ville,d.antecedants_med,
        d.antecedants_chirg,d.antecedants_fam,d.allergies,d.indicateur_bio,d.traitement_chr,d.nom,d.prenom,d.sexe,
        d.datenaissance,d.lieunaissance,
        d.tel,d.email,d.contactdurgence,d.image,c.lib as pays,d.cp,d.rue,d.nss,pro.lib as profession,d.created_at,d.updated_at
         FROM dossiers as d,bloodtypes as b,professions as pro,countries as c,villes as v
         WHERE d.groupe_sanguin=b.id
         and d.profession=pro.id
         and d.pays=c.code
         and v.id_ville=d.ville
         and d.id="' . $id_dossier . '"'));
        $resultats = DB::select(DB::raw('SELECT DISTINCT(c.id),
        c.date,
        m.lib as motif,
        c.poids,
        c.taille,
        c.ta,
        c.observation,
        c.observation_prive,
        c.effet_marquant,
        c.remarques,
        c.effet_marquant_txt, 
        concat( med.nom ," ", med.prenom) as med ,
        id_medecin,
        c.id_dossier,
        c.created_at,
        c.updated_at
         FROM consultations as c
         left join motifs as m on c.motif=m.id
         left join medecintraitants as med on med.id=c.id_medecin
         WHERE c.id=' . $idC));
        $files = DB::select(DB::raw('select * from consultationfiles where idConsultation=' . $idC));
        $date = date("d-m-Y");
        return view('representant.dossiers.consultations.imprimer', [
            'data' => $data, 'resultats' => $resultats,
            'files' => $files, 'date' => $date
        ]);
    }

    public function store(Request $request)
    {
        if ($request->has('effet_marquant')) {
            $effet = 1;
        } else {
            $effet = 0;
        }
        $consultation = new Consultation();
        $consultation->date = $request->input('date');
        $consultation->id_medecin =  $request->input('id_medecin');
        $consultation->motif = $request->input('motif');
        $consultation->taille = $request->input('taille');
        $consultation->ta = $request->input('ta');
        $consultation->pouls = $request->input('pouls');
        $consultation->poids = $request->input('poids');
        $consultation->observation = $request->input('observation');
        $consultation->observation_prive = $request->input('observation_prive');
        $consultation->effet_marquant = $effet;
        $consultation->effet_marquant_txt = $request->input('effet_marquant_txt');
        $consultation->id_dossier = $request->input('id_dossier');
        $consultation->created_by = Auth::user()->id;
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
        $id = $request->input('id_dossier');
        $dossier = Dossier::where('id', '=', $id)->firstOrFail();
        $dossier->taille = $request->input('taille');
        $dossier->poids = $request->input('poids');
        $dossier->save();

        return  redirect('/representant/dossiers/consultations/show/' . $consultation->id);
    }

    public function showExamenfiles($id)
    {
        $dossier = Consultation::findorfail($id)->first();
        $dossier = Dossier::findorfail($dossier->id_dossier)->first();
        $files = ConsultationFiles::where('idConsultation', '=', $id)->get();
        return view('representant.dossiers.consultations.files', [
            'files' => $files,
            'dossier' => $dossier
        ]);
    }

    public function getDownload($id)
    {
        $resultat = DB::select(DB::raw('select * from consultationfiles where id=' . $id));
        $file = public_path() . "/uploads/consultation/" . $resultat[0]->downloads;
        return Response::download($file, $resultat[0]->downloads);
    }
}
