<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'title', 'handle', 'description', 'description_html',
        'image_url', 'image_alt_text', 'seo',
    ];

    protected $casts = [
        'seo' => 'array',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'collection_products')
            ->withPivot('sort_order')
            ->withTimestamps()
            ->orderBy('collection_products.sort_order');
    }

    public function gid(): string
    {
        return "gid://bravecart/Collection/{$this->id}";
    }
}
