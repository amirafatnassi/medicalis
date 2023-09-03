<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplyfilesMedPat extends Model
{
    public $timestamps = false;
    protected $fillable = ['downloads','id_reply_med_patients'];

    public function replyMedPatient(){
        return $this->belongsTo(ReplyMedPatient::class);
    }
}
