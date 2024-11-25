<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // Menentukan kolom primary key yang benar
    protected $primaryKey = 'service_id'; // Menggunakan service_id sebagai primary key

    // Jika nama tabel berbeda dari konvensi plural, tentukan nama tabel
    protected $table = 'services'; // Nama tabelnya adalah 'services'

    // Tentukan kolom-kolom yang dapat diisi
    protected $fillable = ['service_name', 'description', 'price'];

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
