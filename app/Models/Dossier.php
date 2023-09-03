<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Dossier extends Authenticatable implements AuthenticatableContract
{

    protected $guard = 'patient';
    protected $fillable = [
        'id',
        'groupe_sanguin',
        'taille',
        'poids',
        'antecedants_med',
        'antecedants_chirg',
        'antecedants_fam',
        'allergies',
        'indicateur_bio',
        'traitement_chr',
        'user_id',
        'contactdurgence',
        'nss',
        'convention_id'
    ];
    protected $hidden = ['password', 'remember_token',];
    public $autoincrement = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function files()
    {
        return $this->hasMany(DossierFile::class, 'idDossier');
    }

    public function demandesConsultations()
    {
        return $this->hasMany(DemandeConsultation::class, 'dossier_id');
    }

    public function bloodtype()
    {
        return $this->belongsTo(Bloodtype::class, 'groupe_sanguin');
    }


    public function consultation()
    {
        return $this->hasMany(Consultation::class, 'id_dossier');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dossierUsers()
    {
        return $this->hasMany(DossierUser::class, 'dossier_id');
    }

    public function accessibleDossiers()
    {
        return $this->hasManyThrough(Dossier::class, DossierUser::class, 'user_id', 'id', 'id', 'dossier_id');
    }

    public function replies()
    {
        return $this->hasMany(ReplyMedPatient::class, 'emetteur_id');
    }
}
