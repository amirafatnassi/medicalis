<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bloodtype extends Model
{
    protected $fillable = ['lib'];
    
    public function dossiers()
    {
        return $this->hasMany(Dossier::class, 'groupe_sanguin');
    }
    
    public function patient()
    {
        return $this->hasMany(Patient::class, 'groupe_sanguin');
    }
}
