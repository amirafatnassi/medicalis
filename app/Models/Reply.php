<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['emetteur_id', 'destination_id', 'discussion_id', 'content', 'status'];

    public function emetteur()
    {
        return $this->belongsTo(User::class,'emetteur_id');
    }

    public function destinataire()
    {
        return $this->belongsTo(User::class,'destination_id');
    }

    public function discussion()
    {
        return $this->belongsto('App\Models\Discussion');
    }

    public function files()
    {
        return $this->hasMany(Replyfiles::class,'idReply');
    }
}
