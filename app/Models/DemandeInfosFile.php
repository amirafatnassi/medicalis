<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DemandeInfosFile extends Model{
    public $timestamps = false;
    protected $fillable = ['downloads','idDemandeCons'];
}
