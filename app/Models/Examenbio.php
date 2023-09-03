<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examenbio extends Model
{
    protected $fillable = ['date', 'id_medecin', 'lettre', 'url_bio', 'dossier', 'remarques'];

    public function files()
    {
        return $this->hasMany(Exbiofiles::class, 'idexbio');
    }

    public function medecin()
    {
        return $this->belongsTo(User::class, 'id_medecin');
    }

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
