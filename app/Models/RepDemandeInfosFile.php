<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RepDemandeInfosFile extends Model{
    public $timestamps = false;
    protected $fillable = ['downloads','idRepDemandeInfos'];
}
