<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DossierUserSpecialite extends Model
{
    protected $table = 'dossier_user_specialite';

    protected $fillable = ['dossier_user_id', 'specialite_id'];

    public function dossierUser()
    {
        return $this->belongsTo(DossierUser::class);
    }

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }
}