<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_id',
        'price',
        'payed',
        'transaction_id',
        'payed_at',
        'expired_at',
        'meta'
    ];
    function order(){
        return $this->belongsTo(Order::class );

    }
}
