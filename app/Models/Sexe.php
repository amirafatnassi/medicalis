<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sexe extends Model
{
    protected $fillable = ['lib'];
    
    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }
}
