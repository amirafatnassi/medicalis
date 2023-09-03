<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepDemandeInfos extends Authenticatable
{
    use HasApiTokens, HasFactory;
    use Notifiable;
    use SoftDeletes;
    protected $table = 'rep_demande_infos';
    protected $fillable = [
        'status_id',
        'created_by',
        'observation',
        'demande_infos_id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function files()
    {
        return $this->hasMany(RepDemandeInfosFile::class, 'idRepDemandeInfos');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
