<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientCoordinateur extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    protected $table = 'patient_coordinateur';
    protected $fillable = [
        'patient_id',
        'coordinateur_id',
        'actif'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Models\User', 'patient_id');
    }
    public function Coordinateur()
    {
        return $this->belongsTo('App\Models\User', 'coordinateur_id');
    }
}
