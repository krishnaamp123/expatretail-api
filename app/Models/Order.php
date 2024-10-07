<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_customer',
        'total_price',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }

    public function details()
    {
        return $this->hasMany(DetailOrder::class, 'id_order');
    }
}
