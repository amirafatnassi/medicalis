<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetail extends Authenticatable
{
    use HasApiTokens, HasFactory;
    use Notifiable;
    use SoftDeletes;
    protected $table = 'invoice_detail';
    protected $fillable = [
        'description',
        'name',
        'discount',
        'quantity',
        'is_free',
        'prix_unitaire',
        'Prix_ht',
        'Prix_ttc',
        'invoice_id'
    ];
}
