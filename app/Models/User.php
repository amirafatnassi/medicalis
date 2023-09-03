<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'nom', 'prenom', 'password', 
        'role_id',
        'tel', 'email',
        'country_id', 'ville_id', 'cp', 'rue',
        'sexe_id',
        'datenaissance', 'lieunaissance',
        'profession_id',
        'specialite_id',
        'image',
        'verification_token',
        'email_verified_at',
        'user_approuved_at',
        'user_approuved_by',
        'supervisor_id'
    ];


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function Sexe()
    {
        return $this->belongsTo(Sexe::class, 'sexe_id');
    }

    public function Profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }

    public function Specialite()
    {
        return $this->belongsTo(Specialite::class, 'specialite_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function Ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }

    public function Organisme()
    {
        return $this->belongsTo(Organisme::class, 'organisme_id');
    }

    public function dossierUsers()
    {
        return $this->hasMany(DossierUser::class, 'user_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function supervisedUsers()
    {
        return $this->hasMany(User::class, 'supervisor_id');
    }

    public function representingCoordinateur()
    {
        return $this->hasMany(RepresentantCoordinateur::class, 'representant_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'sender_id');
    }
    

    public function demandesDevis()
    {
        return $this->belongsToMany(DemandeDevis::class, 'destinataires_demande_devis', 'user_id', 'demande_devis_id')
            ->withTimestamps();
    }
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function emailVerifiedAt()
    {
        return 'email_verified_at';
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
