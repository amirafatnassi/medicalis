<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDemande extends Model
{
    protected $table='type_demande';
    protected $fillable = ['lib'];
    use HasFactory;
}
