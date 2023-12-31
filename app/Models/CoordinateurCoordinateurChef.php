<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoordinateurCoordinateurChef extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    protected $table = 'coordinateur_coordinateur_chef';
    protected $fillable = [
        'coordinateur_id',
        'coordinateurChef_id',
        'actif'
    ];

    public function Coordinateur()
    {
        return $this->belongsTo('App\Models\User', 'coordinateur_id');
    }
    public function CoordinateurChef()
    {
        return $this->belongsTo('App\Models\User', 'coordinateurChef_id');
    }
}
