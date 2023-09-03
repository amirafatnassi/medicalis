<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Discussion extends Model
{
  protected $fillable = ['emetteur_id', 'destination_id', 'dossier_id', 'title', 'slug', 'content', 'type_courrier', 'etat', 'rep', 'cloture'];

  public function dossier()
  {
    return $this->belongsTo(Dossier::class);
  }

  public function emetteur()
  {
    return $this->belongsTo(User::class, 'emetteur_id');
  }

  public function destinataire()
  {
    return $this->belongsTo(User::class, 'destination_id');
  }


  public function replies()
  {
    return $this->hasMany(Reply::class, 'discussion_id');
  }

  public function watchers()
  {
    return $this->hasMany(Watcher::class);
  }

  public function is_being_watched_by_auth_user()
  {
    $id = Auth::user()->id;
    $watchers_ids = array();
    foreach ($this->watchers as $w) :
      array_push($watchers_ids, $w->user_id);
    endforeach;
    if (in_array($id, $watchers_ids)) {
      return true;
    } else {
      return false;
    }
  }
}
