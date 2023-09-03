<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Models\InvoiceLine;

class Invoice extends Authenticatable
{
    use HasApiTokens, HasFactory;
    use Notifiable;
    use SoftDeletes;
    protected $table = 'invoices';
    protected $fillable = [
        'tva',
        'total_ht',
        'total_ttc',
        'currency',
        'demande_devis_id', 
        'status_id',
        'receiver_id',
        'sender_id',
        'payment_info',
        'note',
        'date',
        'due_date',
    ];

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class,'invoice_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusInvoice::class, 'status_id');
    }
}
