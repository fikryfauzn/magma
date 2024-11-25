<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
}

class BookingService extends Model
{
    use HasFactory;
    protected $table = 'booking_services'; // Pastikan nama tabel benar
    protected $primaryKey = 'booking_service_id'; // Pastikan kolom ini ada di tabel
    protected $fillable = ['booking_id', 'service_id', 'status', 'price', 'created_at']; // Kolom yang bisa diisi

    // Relasi ke tabel bookings
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    // Relasi ke tabel services
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');

      protected $fillable = [
        'booking_id',
        'service_id',
    ];

//     public function service()
//     {
//         return $this->belongsTo(Service::class, 'service_id', 'service_id');
//     }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }
}
