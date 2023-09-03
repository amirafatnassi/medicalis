<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $fillable = ['code','lib'];
    
     public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }
}
