<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Products::class);
    }

    public function getTotalAttribute() {
        return $this->products()->sum('price') / 100; // 2990 => 29.9
    }
}
