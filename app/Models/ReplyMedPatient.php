<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplyMedPatient extends Model
{
    protected $fillable = [
        'emetteur_id',
        'destination_id',
        'discussion_id',
        'content',
        'status '
    ];

    public function discussion()
    {
        return $this->belongsTo(DiscussionsMedPatient::class, 'discussion_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function emetteur()
    {
        return $this->belongsTo(User::class, 'emetteur_id');
    }


    public function destinataire()
    {
        return $this->belongsTo(User::class, 'destination_id');
    }

    public function files()
    {
        return $this->hasMany(ReplyfilesMedPat::class, 'id_reply_med_patients');
    }
}
