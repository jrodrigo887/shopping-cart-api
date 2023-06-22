<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'total',
    ];

    public function gettotalAttribute() {
        return $this->attributes['total'] / 100; // 2990 => 29.9
    }
    public function settotalAttribute($attr) {
        return $this->attributes['total'] = $attr * 100;
    }

    public function getAssociatedProducts()
    {
        return $this->products();
    }


    public function products(): HasMany
    {
        return $this->hasMany(Products::class);
    }
}
