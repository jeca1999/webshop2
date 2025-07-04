<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'products', // JSON: [{id, name, qty, price}]
        'address',
        'mode_of_payment',
        'status',
        'order_code',
    ];

    protected $casts = [
        'products' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function notification()
    {
        return $this->hasOne(\App\Models\OrderNotification::class, 'order_id', 'id');
    }
}
