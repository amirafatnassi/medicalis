<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Dossier;
use App\Models\DiscussionsMedPatient;
use App\Models\ReplyMedPatient;
use App\Models\ReplyfilesMedPat;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Redirect;


class discussionsController extends Controller
{

  public function create()
  {
    $dossier = Dossier::where('user_id', Auth::user()->id)->first();
    $meds = User::where('role_id', 3)->get();

    return view('patient.discussions.create', compact('meds', 'dossier'));
  }

  public function createById($id)
  {

    $med = User::findorFail($id);
    $dossier = Dossier::where('user_id', Auth::user()->id)->first();

    return view('patient.discussions.createById', compact('dossier', 'med'));
  }

  public function store(Request $r)
  {
    $discussion = new DiscussionsMedPatient();
    $discussion->title = $r->title;
    $discussion->content = $r->content;
    $discussion->dossier_id = $r->dossier_id;
    $discussion->emetteur_id = Auth::user()->id;
    $discussion->type_courrier = $r->type_courrier;
    $discussion->destination_id = $r->destination_id;
    $discussion->slug = Str::slug($r->title) . "-" . time();
    $discussion->etat = 0;
    $discussion->cloture = 0;
    $discussion->save();

    $reply = new ReplyMedPatient();
    $reply->emetteur_id = Auth::user()->id;
    $reply->discussion_id = $discussion->id;
    $reply->destination_id = $r->destination_id;
    $reply->content = $r->content;
    $reply->status = 0;
    $reply->save();

    if ($files = $r->file('filesup')) {
      foreach ($files as $img) {
        $img->move('uploads/courrierMedPatient/', $img->getClientOriginalName());
        $photo = new ReplyfilesMedPat();
        $photo->id_reply_med_patients = $reply->id;
        $photo->downloads = $img->getClientOriginalName();
        $photo->save();
      }
    }
    return redirect('patient/discussions/envoye');
  }

  public function recu()
  {
    $discussions = DiscussionsMedPatient::where('destination_id', Auth::user()->id)
      ->where('cloture', 0)
      ->orderBy('created_at', 'desc')
      ->get();

    return view('patient.discussions.recu', compact('discussions'));
  }

  public function recu_cloture()
  {
    $discussions = DiscussionsMedPatient::where('destination_id', Auth::user()->id)
      ->where('cloture', 1)
      ->orderBy('created_at', 'desc')
      ->get();

    return view('patient.discussions.recu_cloture', compact('discussions'));
  }

  public function envoye()
  {
    $discussions = DiscussionsMedPatient::where('emetteur_id', Auth::user()->id)
      ->where('cloture', 0)
      ->orderBy('created_at', 'desc')
      ->get();

    return view('patient.discussions.envoye', compact('discussions'));
  }

  public function envoye_cloture()
  {
    $discussions = DiscussionsMedPatient::where('emetteur_id', Auth::user()->id)
      ->where('cloture', 1)
      ->orderBy('created_at', 'desc')
      ->get();

    return view('patient.discussions.envoye_cloture', compact('discussions'));
  }

  public function show($slug)
  {
    $d = DiscussionsMedPatient::where('slug', $slug)->first();
    if (Auth::user()->id == $d->destinataire_id) {
      $d->etat = 1;
      $d->save();
    }
    $replies = ReplyMedPatient::where('discussion_id', $d->id)
      ->orderBy('updated_at', 'desc')
      ->get();

    return view('patient.discussions.show', compact('d', 'replies'));
  }

  public function reply($id, Request $r)
  {
    $d = DiscussionsMedPatient::findorFail($id);
    if ($d->cloture == 0) {
      if ($d->emetteur_id == Auth::user()->id) {
        $dest = $d->destination_id;
      } else {
        $dest = $d->emetteur_id;
      }
      $reply = new ReplyMedPatient();
      $reply->emetteur_id = Auth::user()->id;
      $reply->discussion_id = $id;
      $reply->destination_id = $dest;
      $reply->content = $r->reply;
      $reply->status = 0;
      $reply->save();
      $d->content = $r->reply;
      $d->etat = 0;
      $d->updated_at = $reply->created_at;
      $d->save();
      if ($files = $r->file('filesup')) {
        foreach ($files as $img) {
          $profileImage = $img->getClientOriginalName();
          $img->move('uploads/courrierMedPatient', $profileImage);
          $photo = new ReplyfilesMedPat();
          $photo->id_reply_med_patients = $reply->id;
          $photo->downloads = $profileImage;
          $photo->save();
        }
      }
    }
    return Redirect('patient/discussions/envoye');
  }

  public function cloturer($id)
  {
    DiscussionsMedPatient::findorFail($id)->update(['cloture' => 1]);

    return Redirect::back();
  }

  public function forum()
  {
    $discussions = DiscussionsMedPatient::where(function ($query) {
      $query->where('emetteur_id', Auth::user()->id)
        ->orWhere('destination_id', Auth::user()->id);
    })
      ->where('cloture', 0)
      ->orderBy('updated_at', 'desc')
      ->get();


    return view('patient.discussions.forum', ['discussions' => $discussions]);
  }

  public function forum_cloture()
  {
    $discussions = DiscussionsMedPatient::where(function ($query) {
      $query->where('emetteur_id', Auth::user()->id)
        ->orWhere('destination_id', Auth::user()->id);
    })
      ->where('cloture', 1)
      ->orderBy('updated_at', 'desc')
      ->get();


    return view('patient.discussions.forum_cloture', compact('discussions'));
  }
}
