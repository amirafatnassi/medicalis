<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Replyfiles extends Model{
    public $timestamps = false;
    protected $fillable = ['downloads','idReply'];

    public function reply(){
        return $this->belongsTo(Reply::class,'idReply');
    }
}
