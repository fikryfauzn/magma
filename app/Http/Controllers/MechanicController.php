<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\BookingService;
use App\Mail\PHPMailerService;


class MechanicController extends Controller
{
    public function showAvailability()
    {
        // Fetch bookings with no mechanic assigned
        $bookings = Booking::with(['service', 'customer'])
            ->whereNull('mechanic_id') // Only bookings without a mechanic assigned
            ->where('status', 'Pending')
            ->get();

        return view('mechanic.availability', compact('bookings'));
    }

    private function sendCustomerNotification(Booking $booking)
    {
        $customer = $booking->customer;
        $mechanic = auth()->user();

        // Construct the subject and body of the email
        $subject = "Your Service Booking Has Been Scheduled";
        $body = view('emails.booking-scheduled', compact('customer', 'booking', 'mechanic'))->render();

        // Use PHPMailerService to send the email
        $emailService = new PHPMailerService();
        $emailSent = $emailService->sendEmail($customer->email, $subject, $body);

        if (!$emailSent) {
            // You can log or handle the error here
            \Log::error('Failed to send email to customer for booking ID: ' . $booking->booking_id);
        }
    }

    public function claimBooking(Request $request, $bookingId)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($bookingId);

        // Get the currently logged-in user (mechanic)
        $user = auth()->user();

        // Check if the logged-in user has the 'mechanic' role
        if ($user->role !== 'mechanic') {
            // If the user is not a mechanic, show an error message
            return redirect()->route('mechanic.availability')->with('error', 'You are not authorized to claim this booking.');
        }

        // Assign the user_id (mechanic) to the booking's mechanic_id
        $booking->mechanic_id = $user->user_id; // Assign the logged-in user's ID as mechanic_id
        $booking->status = 'In Progress'; // Update the booking status
        $booking->save(); // Save the changes

        // Send notification to the customer
        $this->sendCustomerNotification($booking);

        return back()->with('success', 'Booking claimed successfully.');
    }





    public function updateSchedule(Request $request, $booking_id)
    {
        // Validate the input for schedule date
        $request->validate([
            'schedule_date' => 'required|date|after_or_equal:today',
        ]);

        // Fetch the booking with the related customer and service
        $booking = Booking::with(['customer', 'service'])->findOrFail($booking_id);

        // Get the currently authenticated user
        $user = auth()->user();

        // Check if the logged-in user is a mechanic (based on role)
        if ($user->role !== 'mechanic') {
            return redirect()->route('mechanic.availability')->with('error', 'You are not authorized to update the schedule.');
        }

        // Assign the mechanic_id to the booking (use the user_id from the logged-in mechanic)
        $booking->date_scheduled = $request->schedule_date;
        $booking->mechanic_id = $user->user_id; // Use user_id of logged-in mechanic
        $booking->status = 'Scheduled';
        $booking->save();

        // Notify the customer via email about the schedule update
        $customer = $booking->customer;
        $mechanic = $user; // Logged-in mechanic

        // Prepare email details
        $subject = "Your Service Booking Has Been Scheduled";
        $body = view('emails.booking-scheduled', compact('customer', 'booking', 'mechanic'))->render();

        // Send email to customer using the PHPMailer service
        $emailSent = app(\App\Mail\PHPMailerService::class)->sendEmail($customer->email, $subject, $body);

        if (!$emailSent) {
            return redirect()->back()->with('error', 'Schedule updated, but email notification failed.');
        }

        return redirect()->route('mechanic.availability')->with('success', 'Schedule updated and customer notified.');
    }
}
