<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'name',
        'slug',
        'brand',
        'category',
        'description',
        'full_description',
        'price',
        'old_price',
        'stock',
        'image',
        'is_new',
        'is_promo',
        'is_active',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'stock' => 'integer',
        'is_new' => 'boolean',
        'is_promo' => 'boolean',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Générer un slug unique
     */
    public static function generateSlug($name)
    {
        $slug = \Illuminate\Support\Str::slug($name);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();
        
        return $count ? "{$slug}-{$count}" : $slug;
    }

    /**
     * Accesseur pour l'URL de l'image
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }
        return asset('assets/images/placeholder.png');
    }

    /**
     * Relation avec les images de galerie
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Vérifier si le produit est en stock
     */
    public function getIsInStockAttribute()
    {
        return $this->stock > 0;
    }

    /**
     * Calculer le pourcentage de réduction
     */
    public function getDiscountPercentAttribute()
    {
        if ($this->old_price && $this->old_price > $this->price) {
            return round((($this->old_price - $this->price) / $this->old_price) * 100);
        }
        return 0;
    }
}
