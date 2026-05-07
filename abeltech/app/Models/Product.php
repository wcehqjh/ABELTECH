<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'category', 'price', 'old_price',
        'image', 'description', 'full_description',
        'stock', 'is_new', 'is_promo', 'is_active',
        'brand', 'specs',
    ];

    protected $casts = [
        'specs'    => 'array',
        'is_new'   => 'boolean',
        'is_promo' => 'boolean',
        'is_active'=> 'boolean',
    ];

    // Relations
    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    // Accessors
    public function getDiscountPercentAttribute(): int
    {
        if ($this->old_price && $this->old_price > $this->price) {
            return (int) round((($this->old_price - $this->price) / $this->old_price) * 100);
        }
        return 0;
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('assets/img/product-placeholder.png');
    }

    public function getIsInStockAttribute(): bool
    {
        return $this->stock > 0;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, string $category)
    {
        return $category === 'all'
            ? $query
            : $query->where('category', $category);
    }

    public function scopeSearch($query, string $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%")
              ->orWhere('brand', 'like', "%{$term}%");
        });
    }

    // Auto-slug
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }
}