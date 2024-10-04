<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_order',
        'id_cart',
        'qty',
        'price',
        'total_price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_cart');
    }
}
