<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinataireDemandeDevis extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'demande_devis_id'
    ];
    protected $table = 'destinataires_demande_devis';

    public function demandesDevis()
    {
        return $this->belongsToMany(DemandeDevis::class, 'demande_devis_user', 'user_id', 'demande_devis_id')
            ->withTimestamps();
    }
}
