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
        'quantity',
        'checkout_id'
    ];

    public function getPriceAttribute() {
        return $this->attributes['price'] / 100; // 2990 => 29.9
    }

    public function setPriceAttribute($attr) {
        return $this->attributes['price'] = $attr * 100;
    }

    public function subtotal() {
        if ($this->attributes['quantity'] > 0) {
            return ($this->attributes['price'] * $this->attributes['quantity']) / 100;
        } else {
            return $this->attributes['price'] / 100;
        }
    }

    public function ckeckout() {
        return $this->belongsTo(Checkout::class);
    }
}
