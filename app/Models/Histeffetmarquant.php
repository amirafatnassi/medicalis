<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Histeffetmarquant extends Model
{
    protected $fillable = [
        'id_user',
        'id_consultation',
        'deleted_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'id_consultation');
    }
}
