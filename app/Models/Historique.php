<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    protected $table='historiques';
    protected $fillable = ['lib','id_specialite'];
    
    public function Specialite(){
        return $this->belongsTo(Specialite::class,'id_specialite');
    }
}