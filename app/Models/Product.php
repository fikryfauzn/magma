<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    // Add 'brochure' to the fillable fields
    protected $fillable = ['name', 'description', 'price', 'image', 'tracking_id', 'slug', 'brochure'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            // Automatically generate a slug based on the product name
            $product->slug = Str::slug($product->name);

            // Ensure the slug is unique by appending a number if needed
            $originalSlug = $product->slug;
            $counter = 1;
            while (self::where('slug', $product->slug)->exists()) {
                $product->slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        });

        static::saving(function ($product) {
            if ($product->isDirty('name')) {  // Check if the name has changed
                $product->slug = Str::slug($product->name);
            }
        });

    }
}
