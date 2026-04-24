<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
