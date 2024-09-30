<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_customer',
        'complaint_date',
        'image',
        'production_code',
        'description'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }
}
