<?php

namespace App\Http\Controllers;

use App\Models\BookingService;
use Illuminate\Http\Request;

class ServiceBookingController extends Controller
{
    public function index()
    {
        // Menggunakan eager loading untuk relasi 'booking' dan 'service'
        $bookings = BookingService::with(['booking', 'service'])->paginate(10);  // 10 adalah jumlah item per halaman
    
        return view('admin.manage_service_booking', compact('bookings'));
    }
}
