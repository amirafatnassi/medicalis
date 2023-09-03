<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class GenInvoiceDetail extends Authenticatable
{
    use HasApiTokens, HasFactory;
    use Notifiable;
    use SoftDeletes;
    protected $table = 'gen_invoice_detail';
    protected $fillable = [
        'tva',
        'description',
        'name',
        'discount',
        'quantity',
        'is_free',
        'prix_unitaire',
        'Prix_ht',
        'Prix_ttc',
        'gen_invoice_id'
    ];
}
