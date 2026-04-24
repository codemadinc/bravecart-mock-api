<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'token', 'discount_code', 'discount_amount',
        'note', 'buyer_identity',
    ];

    protected $casts = [
        'buyer_identity' => 'array',
        'discount_amount' => 'decimal:2',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public static function generateToken(): string
    {
        return Str::random(32);
    }

    public function gid(): string
    {
        return "gid://bravecart/Cart/{$this->id}";
    }
}
