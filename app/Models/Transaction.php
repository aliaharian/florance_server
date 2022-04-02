<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'price',
        'transaction_code',
        'pay_terminal',
        'transaction_token',
        'meta'
    ];

    function payment(){
        return $this->belongsTo(OrderPayment::class , 'transaction_code');
    }
}
