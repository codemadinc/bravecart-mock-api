<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'title', 'handle', 'body_html', 'seo',
    ];

    protected $casts = [
        'seo' => 'array',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function gid(): string
    {
        return "gid://bravecart/Page/{$this->id}";
    }
}
