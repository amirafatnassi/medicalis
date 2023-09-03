<?php

namespace App\Http\Controllers\medecin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Discussion;
use App\Models\Reply;
use App\Models\Replyfiles;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class medecinDiscussionsController extends Controller
{
    public function index()
    {
        $loggedInMedecinId = Auth::user()->id;

        $discussions = Discussion::with(['emetteur', 'destinataire', 'replies'])
            ->where(function ($query) use ($loggedInMedecinId) {
                $query->where('emetteur_id', $loggedInMedecinId)
                    ->orWhere('destination_id', $loggedInMedecinId);
            })
            ->where('cloture', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('medecin.discussionMedecin.index', compact('discussions'));
    }

    public function create()
    {
        $meds = User::where('role_id', 3)->get();
        $user = Auth::user();
        $dossiers = $user->dossierUsers->pluck('dossier');

        return view('medecin.discussionMedecin.create', compact('dossiers', 'meds'));
    }

    public function createbyid($id)
    {
        $dossiers = User::findOrFail(Auth::user()->id)
            ->dossiers()->distinct()
            ->get();

        $med = User::findorFail($id);

        return view('medecin.discussionMedecin.createbyid', compact('dossiers', 'med'));
    }

    public function recuMedecin()
    {
        $discussions = Discussion::with('replies', 'emetteur', 'destinataire')
            ->where('destination_id', Auth::user()->id)
            ->where('cloture', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('medecin.discussionMedecin.recu', compact('discussions'));
    }

    public function envoyeMedecin()
    {
        $discussions = Discussion::with('replies', 'destinataire', 'emetteur')
            ->where('emetteur_id', Auth::user()->id)
            ->where('cloture', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('medecin.discussionMedecin.envoye', compact('discussions'));
    }

    public function store(Request $r)
    {
        $discussion = new Discussion();
        $discussion->title = $r->sujet;
        $discussion->content = $r->content;
        $discussion->dossier_id = $r->dossier_id;
        $discussion->type_courrier = $r->type_courrier;
        $discussion->destination_id = $r->destination_id;
        $discussion->emetteur_id = Auth::user()->id;
        $discussion->slug = Str::slug($r->title) . "-" . time();
        $discussion->etat = 0;
        $discussion->cloture = 0;
        $discussion->save();
        $reply = new Reply();
        $reply->emetteur_id = Auth::user()->id;
        $reply->discussion_id = $discussion->id;
        $reply->destination_id = $r->destination_id;
        $reply->content = $r->content;
        $reply->status = 0;
        $reply->save();
        if ($files = $r->file('filesup')) {
            foreach ($files as $img) {
                $img->move('uploads/courrier/', $img->getClientOriginalName());
                $photo = new Replyfiles;
                $photo->idReply = $reply->id;
                $photo->downloads = $img->getClientOriginalName();
                $photo->save();
            }
        }
        return redirect('/medecin/forum/envoye');
    }


    public function storebyid(Request $r)
    {
        $discussion = new Discussion();
        $discussion->title = $r->sujet;
        $discussion->content = $r->content;
        $discussion->dossier_id = $r->dossier_id;
        $discussion->type_courrier = $r->type_courrier;
        $discussion->destination_id = $r->destination_id;
        $discussion->medecin_id = Auth::user()->id;
        $discussion->last_destination_id = $r->destination_id;
        $discussion->last_medecin_id = Auth::user()->id;
        $discussion->slug = Str::slug($r->title) . "-" . time();
        $discussion->etat = 0;
        $discussion->cloture = 0;
        $discussion->save();
        $reply = new Reply();
        $reply->medecin_id = Auth::user()->id;
        $reply->discussion_id = $discussion->id;
        $reply->destination_id = $r->destination_id;
        $reply->content = $r->content;
        $reply->status = 0;
        $reply->save();
        if ($files = $r->file('filesup')) {
            $destinationPath = public_path('/uploads/courrier/');
            foreach ($files as $img) {
                $profileImage = $img->getClientOriginalName();
                $img->move($destinationPath, $profileImage);
                $photo = new Replyfiles;
                $photo->idReply = $reply->id;
                $photo->downloads = "$profileImage";
                $photo->save();
            }
        }
        return redirect('/medecin/forum/envoye');
    }

    public function cloture()
    {
        $loggedInMedecinId = Auth::user()->id;

        $discussions = Discussion::with(['emetteur', 'destinataire', 'replies'])
            ->where(function ($query) use ($loggedInMedecinId) {
                $query->where('emetteur_id', $loggedInMedecinId)
                    ->orWhere('destination_id', $loggedInMedecinId);
            })
            ->where('cloture', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('medecin.discussionMedecin.cloture', ['discussions' => $discussions]);
    }

    public function clotureenvoye()
    {
        $discussions = Discussion::with('replies', 'destinataire', 'emetteur')
            ->where('emetteur_id', Auth::user()->id)
            ->where('cloture', 1)
            ->orderBy('created_at', 'desc')->get();

        return view('medecin.discussionMedecin.clotureenvoye', compact('discussions'));
    }

    public function cloturerecu()
    {
        $discussions = Discussion::with('replies', 'emetetur', 'destinataire')
            ->WHERE('destination_id', Auth::user()->id)
            ->where('cloture', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('medecin.discussionMedecin.cloturerecu', compact('discussions'));
    }

    public function show($slug)
    {
        $d = Discussion::with('emetteur', 'destinataire', 'replies', 'replies.files')
            ->where('slug', $slug)
            ->first();

        if ($d->destination_id == Auth::user()->id) {
            $d->update(['etat' => 1]);
        }
        return view('medecin.discussionMedecin.show', compact('d'));
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
        $d = Discussion::find($id);
        if ($d->cloture == 0) {

            $reply = Reply::create([
                'emetteur_id' => Auth::user()->id,
                'discussion_id' => $id,
                'destination_id' => Auth::user()->id == $d->emetteur_id ? $d->destination_id : $d->emetteur_id,
                'content' => request()->reply
            ]);
            $d->etat = 0;
            $d->content = request()->reply;
            $d->updated_at = $reply->created_at;
            $d->save();
            if ($files = $r->file('filesup')) {
                foreach ($files as $img) {
                    $img->move('uploads/courrier/', $img->getClientOriginalName());
                    $photo = new Replyfiles;
                    $photo->idReply = $reply->id;
                    $photo->downloads = $img->getClientOriginalName();
                    $photo->save();
                }
            }
            $watchers = array();
            foreach ($d->watchers as $watcher) :
                array_push($watchers, User::find($watcher->user_id));
            endforeach;
        }
        return Redirect::back();
    }

    public function cloturer($id)
    {
        Discussion::where('id', $id)->update(['cloture' => 1]);
        return Redirect::back();
    }

    public function getDownload(Request $request)
    {
        if (Stoage::disk('public')->exists("pdf/$request->file")) {
            $path = Stoage::disk('public')->path("pdf/$request->file");
            $content = file_get_contents($path);
            return response($content)->withHeaders(['Content-Type' => mime_content_type($path)]);
        }
    }

    public function download_public(Request $request)
    {
        if (Storage::disk('public')->exists("pdf/$request->file")) {
            $path = Storage::disk('public')->path("/$request->file");
            $content = file_get_contents($path);
            return response($content)->withHeaders(['Content-Type' => mime_content_type($path)]);
        }
    }

    public function uploadfichier(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $folder = 'storage/app/public';
            dd($folder);
            dd($filename);
            $file->storeAs($folder, $filename);
            return $folder;
        }
        return '';
    }
}
