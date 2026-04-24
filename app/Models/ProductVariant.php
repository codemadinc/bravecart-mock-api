<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'title', 'sku', 'price', 'compare_at_price',
        'available_for_sale', 'quantity_available', 'selected_options',
        'image_url', 'weight', 'weight_unit',
    ];

    protected $casts = [
        'selected_options' => 'array',
        'available_for_sale' => 'boolean',
        'price' => 'decimal:2',
        'compare_at_price' => 'decimal:2',
        'weight' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function gid(): string
    {
        return "gid://bravecart/ProductVariant/{$this->id}";
    }
}
