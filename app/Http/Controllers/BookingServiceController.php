<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingService;

class BookingServiceController extends Controller
{
    // Show all services linked to a specific booking
    public function index($bookingId)
    {
        $bookingServices = BookingService::where('booking_id', $bookingId)->get();
        return view('booking_services.index', compact('bookingServices'));
    }
}
