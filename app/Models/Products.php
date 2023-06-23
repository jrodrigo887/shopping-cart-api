<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'decription',
        'price',
        'checkout_id'
    ];

    public function getpriceAttribute() {
        return $this->attributes['price'] / 100; // 2990 => 29.9
    }
    public function setpriceAttribute($attr) {
        return $this->attributes['price'] = $attr * 100;
    }

    public function ckeckout() {
        return $this->belongsTo(Checkout::class);
    }
}
