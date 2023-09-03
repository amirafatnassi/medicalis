<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exbiofiles extends Model{
    public $timestamps = false;
    protected $fillable = ['downloads','idexbio'];

    public function examenbio(){
        return $this->belongsTo(Examenbio::class);
    }
}
