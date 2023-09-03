<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandeInfos extends Authenticatable
{
    use HasApiTokens, HasFactory;
    use Notifiable;
    use SoftDeletes;
    protected $table = 'demande_infos';
    protected $fillable = [
        'status_id',
        'created_by',
        'observation',
        'demande_cons_id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function status()
    {
        return $this->belongsTo(StatusDemande::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function files()
    {
        return $this->hasMany(DemandeInfosFile::class, 'idDemandeInfos');
    }

    public function repInfos()
    {
        return $this->hasOne(RepDemandeInfos::class, 'demande_infos_id');
    }

    public function scopeForDemandeCons($query, $id)
    {
        return $query->with([
            'status', 'user', 'files', 'repInfos', 'repInfos.files'
        ])->where('demande_cons_id', $id);
    }
}
