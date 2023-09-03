<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DossierFile extends Model{
    public $timestamps = false;
    protected $fillable = ['downloads','idDossier'];
    protected $table='dossierFiles';

    public function dossier()
    {
        return $this->hasOne(Dossier::class);
    }
}