<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examenradio extends Model
{
    protected $fillable = ['date', 'url_radio', 'type_radio', 'radio', 'radio2', 'id_medecin', 'lettre', 'remarques', 'dossier'];

    public function typeradio(){
        return $this->belongsTo(Radiotype::class,'type_radio');
    }
    
    public function Radio(){
        return $this->belongsTo(Radio::class,'radio');
    }
    
    public function medecin(){
        return $this->belongsTo(User::class,'id_medecin');
    }

    public function Dossier(){
        return $this->belongsTo(Dossier::class,'dossier');
    }
    
    public function files(){
        return $this->hasMany(Exradiofiles::class,'idexradio');
    }
    
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
    
}
