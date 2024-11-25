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
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookingService;

class Booking extends Model
{
    use HasFactory;

    // Specify the table name (optional, only if not 'bookings')
    protected $table = 'bookings';

    // Specify the primary key
    protected $primaryKey = 'booking_id';

    // Disable auto-increment if the key isn't auto-incrementing
    public $incrementing = true;

    // Set the key type if not an integer
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'mechanic_id',
        'service_id',
        'date_requested',
        'date_scheduled',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }

    public function additionalServices()
    {
        return $this->hasMany(BookingService::class, 'booking_id', 'booking_id');
    }
}
