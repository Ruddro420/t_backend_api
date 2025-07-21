<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposite extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_id',
        'payment_method',
        'payment_phone_number',
        'transaction_id',
        'amount',
        'status',
        'ex1',
        'ex2',
    ];
}
