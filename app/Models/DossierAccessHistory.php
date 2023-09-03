<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DossierAccessHistory extends Model
{
    use HasFactory;

    protected $table = 'dossier_access_history';

    protected $fillable = [
        'dossier_id',
        'user_id',
        'granted',
        'created_by',
    ];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class, 'dossier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
