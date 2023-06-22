<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'decription',
        'price',
    ];

    public function getpriceAttribute() {
        return $this->attributes['price'] / 100; // 2990 => 29.9
    }
    public function setpriceAttribute($attr) {
        return $this->attributes['price'] = $attr * 100;
    }

    public function ckeckout(): BelongsTo {
        return $this->belongsTo(Checkout::class)->withDefault();
    }
}
