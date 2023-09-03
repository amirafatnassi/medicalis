<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepresentantCoordinateur extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    protected $table = 'representant_coordinateur';
    protected $fillable = [
        'representant_id',
        'coordinateur_id',
        'actif'
    ];

    public function representant()
    {
        return $this->belongsTo(User::class, 'representant_id');
    }


    public function Coordinateur()
    {
        return $this->belongsTo(User::class, 'coordinateur_id');
    }

}
