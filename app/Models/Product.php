<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'title', 'handle', 'description', 'description_html',
        'product_type', 'vendor', 'status', 'tags', 'images', 'seo',
        'options', 'price_min', 'price_max', 'compare_at_price_min',
        'compare_at_price_max', 'available_for_sale',
    ];

    protected $casts = [
        'tags' => 'array',
        'images' => 'array',
        'seo' => 'array',
        'options' => 'array',
        'available_for_sale' => 'boolean',
        'price_min' => 'decimal:2',
        'price_max' => 'decimal:2',
        'compare_at_price_min' => 'decimal:2',
        'compare_at_price_max' => 'decimal:2',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'collection_products')
            ->withPivot('sort_order')
            ->withTimestamps();
    }

    public function gid(): string
    {
        return "gid://bravecart/Product/{$this->id}";
    }
}
