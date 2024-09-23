<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_customer',
        'id_product',
        'price'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
