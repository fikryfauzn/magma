<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services'; // Table name
    protected $primaryKey = 'service_id'; // Match the primary key column in your table
    protected $fillable = ['service_name', 'description', 'price']; // Match your column names
    public $timestamps = false; // Disable timestamps if `created_at` and `updated_at` are not used

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'service_id', 'service_id');
    }
}
