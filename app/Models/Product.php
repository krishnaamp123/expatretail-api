<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_packaging',
        'product_name',
        'image',
        'description'
    ];

    public function packaging()
    {
        return $this->belongsTo(Packaging::class, 'id_packaging');
    }
}
