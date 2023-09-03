<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'date',
        'motif_id',
        'taille',
        'poids',
        'ta',
        'pouls',
        'observation',
        'observation_prive',
        'effet_marquant',
        'effet_marquant_txt',
        'medecin_id',
        'dossier_id',
        'remarques',
        'created_by'
    ];

    protected $table = 'consultations';

    public function Motif()
    {
        return $this->belongsTo(Motif::class, 'motif_id');
    }

    public function files()
    {
        return $this->hasMany(Consultationfiles::class, 'idConsultation');
    }

    public function medecin()
    {
        return $this->belongsTo(User::class, 'medecin_id');
    }

    public function dossier()
    {
        return $this->belongsTo(Dossier::class, 'dossier_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
