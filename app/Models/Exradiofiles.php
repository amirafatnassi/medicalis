<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exradiofiles extends Model
{
    public $timestamps = false;
    protected $fillable = ['downloads','idexradio'];

    public function examenradio(){
        return $this->belongsTo(Examenradio::class);
    }
}
