<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'handle', 'title', 'items',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function gid(): string
    {
        return "gid://bravecart/Menu/{$this->id}";
    }
}
