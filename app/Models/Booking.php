<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking_services'; // Tentukan nama tabel jika tidak mengikuti konvensi plural
    protected $primaryKey = 'booking_service_id'; // Tentukan primary key jika bukan 'id'
    protected $fillable = [
        'booking_id', 'booking_id', 'service_id', 'created_at', 'updated_at',
    ];
}
