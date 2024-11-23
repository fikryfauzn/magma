<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    use HasFactory;

    // Tentukan primary key jika menggunakan custom primary key
    protected $primaryKey = 'transaction_id';
    
    // Tentukan nama tabel jika tidak menggunakan plural dari model
    protected $table = 'transactions'; 

    // Aktifkan jika kolom timestamps tidak ada (created_at dan updated_at)
    // public $timestamps = false; 

    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'user_id',
        'service_booking_id',
        'product_id',
        'total_amount',
        'transaction_date',
        'status',
        'payment_method',
        'reference_number',
        'transaction_type',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi dengan model ServiceBooking (jika ada)
    public function serviceBooking()
    {
        return $this->belongsTo(ServiceBooking::class);
    }


}
