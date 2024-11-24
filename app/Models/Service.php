<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // Menentukan kolom primary key yang benar
    protected $primaryKey = 'service_id'; // Menggunakan service_id sebagai primary key

    // Jika nama tabel berbeda dari konvensi plural, tentukan nama tabel
    protected $table = 'services'; // Nama tabelnya adalah 'services'

    // Tentukan kolom-kolom yang dapat diisi
    protected $fillable = ['service_name', 'description', 'price'];
}
