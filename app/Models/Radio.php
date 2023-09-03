<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Radio extends Model{
    protected $fillable = ['lib', 'typeradio'];

    public function typeradio(){
        return $this->belongsTo(Radiotype::class);
    }
}