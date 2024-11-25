<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use App\Mail\PHPMailerService;

class BookingController extends Controller
{

    public function create()
{
    $services = Service::all();

    return view('bookings.create', compact('services'));
}
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,service_id',
            'date_requested' => 'required|date|after_or_equal:today',
        ]);

        // Create a new booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'date_requested' => $request->date_requested,
            'status' => 'Pending',
        ]);

        // If there are additional services to link
        if ($request->has('additional_services')) {
            foreach ($request->additional_services as $serviceId) {
                BookingService::create([
                    'booking_id' => $booking->booking_id,
                    'service_id' => $serviceId,
                ]);
            }
        }

        // Get the authenticated user
        $user = Auth::user();

        // Prepare email details
        $subject = "Booking Confirmation - Service #{$booking->booking_id}";
        $body = view('emails.booking_confirmation', [
            'user' => $user,
            'booking' => $booking,
        ])->render();

        // Send the email using PHPMailer
        $emailService = new PHPMailerService();
        $emailSent = $emailService->sendEmail($user->email, $subject, $body);

        if (!$emailSent) {
            return redirect()->route('bookings.index')->with('error', 'Booking created but confirmation email failed to send.');
        }

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully! A confirmation email has been sent.');
    }

    public function index()
    {
        $bookings = Booking::with(['service', 'additionalServices'])->where('user_id', Auth::id())->get();
        return view('bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with('service', 'additionalServices.service')->findOrFail($id);

        return view('bookings.show', compact('booking'));
    }
}
