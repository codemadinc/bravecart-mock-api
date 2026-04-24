<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'title', 'handle', 'body',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function gid(): string
    {
        return "gid://bravecart/ShopPolicy/{$this->id}";
    }
}
