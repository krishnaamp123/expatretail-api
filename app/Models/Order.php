<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_customer',
        'id_cart',
        'total_price'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_cart');
    }

    public function details()
    {
        return $this->hasMany(DetailOrder::class, 'id_order');
    }
}
