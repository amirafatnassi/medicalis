<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActeDetail extends Model
{
    protected $fillable = ['lib','acte_id'];
    use HasFactory;
}

    