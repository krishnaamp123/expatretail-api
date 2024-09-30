<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_customer',
        'id_customer_product',
        'qty'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }

    public function customerProduct()
    {
        return $this->belongsTo(CustomerProduct::class, 'id_customer_product');
    }
}
