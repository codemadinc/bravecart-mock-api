<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'name', 'color', 'image_url',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
