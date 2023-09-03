<?php

namespace App\Http\Controllers\medecin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Dossier;
use App\Models\DiscussionsMedPatient;
use App\Models\ReplyMedPatient;
use App\Models\ReplyfilesMedPat;
use App\Models\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class medecinPatientDiscussionsController extends Controller
{
    public function discussionMedPatient()
    {
        $discussions = DiscussionsMedPatient::with('replies','emetteur','destinataire')
            ->where('emetteur_id', Auth::user()->id)
            ->orWhere('destination_id', Auth::user()->id)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('medecin.discussionMedPatient.index', compact('discussions'));
    }

    public function discussionMedPatientRecu()
    {
        $discussions = DiscussionsMedPatient::with('emetteur', 'emetteur', 'destinataire')
            ->where('destination_id', Auth::user()->id)
            ->where('cloture', 0)
            ->get();

        return view('medecin.discussionMedPatient.recu', compact('discussions'));
    }

    public function cloturerecu()
    {
        $discussions = DiscussionsMedPatient::with('replies')
            ->where('destination_id', Auth::user()->id)
            ->where('cloture', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('medecin.discussionMedPatient.cloturerecu', compact('discussions'));
    }

    public function discussionMedPatientEnvoye()
    {
        $discussions = DiscussionsMedPatient::with('replies', 'destinataire')
            ->where('emetteur_id', Auth::user()->id)
            ->where('cloture', 0)
            ->get();

        return view('medecin.discussionMedPatient.envoye', compact('discussions'));
    }

    public function clotureenvoye()
    {
        $discussions = DiscussionsMedPatient::with('replies', 'destinataire')
            ->where('emetteur_id', Auth::user()->id)
            ->where('cloture', 1)
            ->get();
        
        return view('medecin.discussionMedPatient.clotureenvoye', compact('discussions'));
    }

    public function create()
    {
        $user = Auth::user();
        $accessibleDossiers = $user->dossierUsers->pluck('dossier');
        return view('medecin.discussionMedPatient.create', compact('accessibleDossiers'));
    }

    public function createbyid($id)
    {
        $liste_patients = Dossier::where('id', Auth::user()->id)->get();
        $dossier = Dossier::findorFail($id);
        return view('medecin.discussionMedPatient.createbyid', compact('liste_patients', 'dossier'));
    }

    public function store(Request $r)
    {
        $discussion = new DiscussionsMedPatient();
        $discussion->title = $r->title;
        $discussion->content = $r->content;
        $discussion->type_courrier = $r->type_courrier;
        $discussion->destination_id = $r->destination_id;
        $discussion->emetteur_id = Auth::user()->id;
        $dossier = Dossier::where('user_id', $r->destination_id)->first();
        if ($dossier) {
            $discussion->dossier_id = $dossier->id;
        }
        $discussion->slug = Str::slug($r->title) . "-" . time();
        $discussion->etat = 0;
        $discussion->cloture = 0;
        $discussion->content = $r->content;
        $discussion->save();
        $reply = new ReplyMedPatient();
        $reply->emetteur_id = Auth::user()->id;
        $reply->destination_id = $r->destination_id;
        $reply->discussion_id = $discussion->id;
        $reply->content = $r->content;
        $reply->status = 0;
        $reply->save();
        if ($files = $r->file('filesup')) {
            foreach ($files as $img) {
                $img->move('uploads/courrierMedPatient', $img->getClientOriginalName());
                $photo = new ReplyfilesMedPat();
                $photo->id_reply_med_patients = $reply->id;
                $photo->downloads = $img->getClientOriginalName();
                $photo->save();
            }
        }
        return redirect('/medecin/forumMedPatient/envoye');
    }

    public function cloture()
    {
        $discussions = DiscussionsMedPatient::with('emetteur', 'destinataire', 'replies')
            ->where('emetteur_id', Auth::user()->id)
            ->where('cloture', 1)
            ->orWhere('destination_id', Auth::user()->id)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('medecin.discussionMedPatient.cloture', compact('discussions'));
    }

    public function show($slug)
    {
        $d = DiscussionsMedPatient::with('replies', 'emetteur', 'destinataire')->where('slug', $slug)->first();
        if ($d->destination_id == Auth::user()->id) {
            $d->etat = 1;
            $d->save();
        }

        return view('medecin.discussionMedPatient.show',  compact('d'));
    }

    public function reply($id, Request $r)
    {
        $validator = Validator::make($r->all(), [
            'reply' => 'required',
        ], [
            'reply.required' => 'Le champ réponse est requis.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $d = DiscussionsMedPatient::find($id);

        $reply = new ReplyMedPatient();
        $reply->emetteur_id = Auth::user()->id;
        $reply->destination_id = Auth::user()->id == $d->emetteur_id ? $d->destination_id : $d->emetteur_id;
        $reply->discussion_id = $id;
        $reply->content = $r->reply;
        $reply->status = 0;
        $reply->save();
        $d->content = $r->reply;
        $d->etat = 0;
        $d->updated_at = $reply->created_at;
        $d->save();

        if ($files = $r->file('filesup')) {
            foreach ($files as $img) {
                $img->move('uploads/courrierMedPatient', $img->getClientOriginalName());
                $photo = new ReplyfilesMedPat();
                $photo->id_reply_med_patients = $reply->id;
                $photo->downloads = $img->getClientOriginalName();
                $photo->save();
            }
        }
        return  Redirect::back();
    }

    public function cloturer($id)
    {
        $d = DiscussionsMedPatient::find($id);
        $d->cloture = 1;
        $d->save();
        return Redirect::back();
    }
}
