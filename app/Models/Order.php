<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // User who placed the order
        'total_price', // The total amount of the order
        'status', // Payment status (e.g., pending, completed)
        'name', 'email', 'phone', 'address', 'city', 'postal_code', 'notes' // Customer details
    ];
}
