<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model{
    protected $primaryKey = 'id_ville';
    protected $fillable = ['name','code','latitude','longitude'];

    public function pays(){
        return $this->belongsTo(Country::class, 'code');
    }
    
    public function dossiers()
    {
        return $this->hasMany(Dossier::class, 'ville');
    }
}