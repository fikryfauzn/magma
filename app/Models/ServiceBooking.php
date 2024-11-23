<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBooking extends Model
{
    use HasFactory;

    protected $table = 'service_bookings'; // Nama tabel yang sesuai di database
    protected $fillable = ['service_id', 'booking_id', 'status']; // Sesuaikan dengan kolom tabel Anda
}
