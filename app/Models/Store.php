<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'handle', 'description', 'domain',
        'logo_url', 'currency_code', 'language_code',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function themePages()
    {
        return $this->hasMany(ThemePage::class);
    }

    public function themeSettings()
    {
        return $this->hasOne(ThemeSettings::class);
    }

    public function swatches()
    {
        return $this->hasMany(Swatch::class);
    }

    /**
     * Generate a Shopify-compatible GID.
     */
    public function gid(): string
    {
        return "gid://bravecart/Shop/{$this->id}";
    }
}
