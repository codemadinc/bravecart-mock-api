<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'title', 'handle', 'seo',
    ];

    protected $casts = [
        'seo' => 'array',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function gid(): string
    {
        return "gid://bravecart/Blog/{$this->id}";
    }
}
