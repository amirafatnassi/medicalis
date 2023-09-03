<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandeDevis extends Authenticatable
{
    use HasApiTokens, HasFactory;
    use Notifiable;
    use SoftDeletes;
    protected $table = 'demande_devis';
    protected $fillable = [
        'status_id',
        'type_demande_id',
        'destinataire_id',
        'demande_cons_id',
        'objet',
        'observation',
        'created_by'
    ];

    public function typeDemande()
    {
        return $this->belongsTo(TypeDemande::class, 'type_demande_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusDemande::class, 'status_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function destinataires()
    {
        return $this->belongsToMany(User::class, 'destinataires_demande_devis', 'demande_devis_id', 'user_id')
            ->withTimestamps();
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'demande_devis_id');
    }
    
    public function demandeConsultation()
    {
        return $this->belongsTo(DemandeConsultation::class, 'demande_cons_id');
    }
}
