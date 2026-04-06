<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image_url',
        'slug',
        'discount',
        'is_paused',
        'reports_count'
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'price' => 'decimal:2',
        'discount' => 'integer',
        'is_paused' => 'boolean',
        'reports_count' => 'integer'
    ];

    /**
     * Get the final price after discount.
     */
    public function getFinalPriceAttribute()
    {
        if ($this->discount > 0) {
            return round($this->price * (1 - ($this->discount / 100)), 2);
        }
        return (float) $this->price;
    }

    /**
     * Get the translated name.
     */
    public function getTranslatedNameAttribute()
    {
        return $this->name[app()->getLocale()] ?? $this->name['en'] ?? '';
    }

    /**
     * Get the translated description.
     */
    public function getTranslatedDescriptionAttribute()
    {
        return $this->description[app()->getLocale()] ?? $this->description['en'] ?? '';
    }

    /**
     * Get the wishlist entries for the product.
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Get the reviews for the product.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get average rating.
     */
    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }

    /**
     * Get the category for the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the order items for the product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
