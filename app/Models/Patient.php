<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'groupe_sanguin',
        'taille',
        'poids',
        'antecedants_med',
        'antecedants_chirg',
        'antecedants_fam',
        'allergies',
        'indicateur_bio',
        'traitement_chr',
        'nom',
        'prenom',
        'sexe',
        'datenaissance',
        'lieunaissance',
        'tel',
        'email',
        'profession',
        'contactdurgence',
        'pays',
        'ville',
        'cp',
        'rue',
        'nss',
        'approuver',
        'login', 
        'password',
        'verification_token',
        'email_verified_at',
         'image'
    ];

    public function bloodtype()
    {
        return $this->belongsTo(Bloodtype::class, 'groupe_sanguin');
    }

    public function Sexe()
    {
        return $this->belongsTo(Sexe::class, 'sexe');
    }

    public function Profession()
    {
        return $this->belongsTo(Profession::class, 'profession');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'pays');
    }

    public function Ville()
    {
        return $this->belongsTo(Ville::class,'ville');
    }

    public function emailVerifiedAt()
    {
        return 'email_verified_at';
    }
    
    public function getAuthPassword()
    {
        return $this->pwd;
    }
    public function getRememberTokenName()
    {
        return '';
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
