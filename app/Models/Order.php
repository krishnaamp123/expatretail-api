<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_customer_product',
        'qty',
        'total_price'
    ];

    public function customerProduct()
    {
        return $this->belongsTo(CustomerProduct::class, 'id_customer_product');
    }
}
