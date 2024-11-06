<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Product extends Model
{

    protected $primaryKey = 'product_id';
    protected $fillable = ['name', 'description', 'price', 'image', 'tracking_id', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);

            // Ensure the slug is unique by appending a number if needed
            $originalSlug = $product->slug;
            $counter = 1;
            while (self::where('slug', $product->slug)->exists()) {
                $product->slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        });
    }
}

