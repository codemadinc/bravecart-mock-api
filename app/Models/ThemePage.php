<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'type', 'handle', 'items',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
