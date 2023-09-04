<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandeConsultation extends Authenticatable
{
    use HasApiTokens, HasFactory;
    use Notifiable;
    use SoftDeletes;
    protected $table = 'demande_consultation';
    protected $fillable = [
        'dossier_id',
        'status_id',
        'type_demande_id',
        'coordinateur_en_charge',
        'objet',
        'created_by',
        'closed_by','closed_at'
    ];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class, 'dossier_id');
    }
    
    public function status()
    {
        return $this->belongsTo(StatusDemande::class,'status_id');
    }

    public function TypeDemande()
    {
        return $this->belongsTo(TypeDemande::class,'type_demande_id');
    }

    public function coordinateurEnCharge()
    {
        return $this->belongsTo(User::class,'coordinateur_en_charge');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function files()
    {
        return $this->hasMany(DemandeConsFiles::class, 'idDemandeCons');
    }

    public function genInvoice()
    {
        return $this->hasOne(GenInvoice::class,'demande_cons_id');
    }

    public function demandeDevis()
    {
        return $this->hasMany(DemandeDevis::class,'demande_cons_id');
    }

    public function demandeInfos()
    {
        return $this->hasMany(DemandeInfos::class,'demande_cons_id');
    }
}
