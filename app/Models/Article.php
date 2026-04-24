<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id', 'title', 'handle', 'excerpt', 'content_html',
        'author_name', 'image_url', 'image_alt_text', 'tags',
        'seo', 'published_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'seo' => 'array',
        'published_at' => 'datetime',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function gid(): string
    {
        return "gid://bravecart/Article/{$this->id}";
    }
}
