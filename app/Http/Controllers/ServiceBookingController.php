<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceBookingController extends Controller
{
    // Menampilkan daftar booking
    public function index()
    {
        $bookings = Booking::paginate(10); // Ambil data booking dengan pagination
        return view('admin.manage_service_booking', compact('bookings'));
    }

    // Menampilkan halaman edit untuk booking layanan
    public function edit($booking_id)
    {
        $booking = Booking::findOrFail($booking_id); // Temukan booking berdasarkan ID
        $services = Service::all(); // Ambil semua layanan
        return view('admin.edit_service_booking', compact('booking', 'services'));
    }

    // Update data booking
    public function update(Request $request, $booking_id)
    {
        // Validasi input
        $validated = $request->validate([
            'service_id' => 'required|exists:services,service_id',
            'date_scheduled' => 'required|date',
            'status' => 'required|string',
        ]);

        $booking = Booking::findOrFail($booking_id); // Temukan booking berdasarkan ID
        $booking->service_id = $request->service_id; // Update service_id
        $booking->date_scheduled = $request->date_scheduled; // Update date_scheduled
        $booking->status = $request->status; // Update status
        $booking->save(); // Simpan perubahan

        // Redirect ke halaman manage service booking dengan pesan sukses
        return redirect()->route('admin.manage_service_booking')->with('success', 'Booking service updated successfully!');
    }

    // Menghapus booking service
    public function destroy($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        $booking->delete(); // Hapus booking

        return redirect()->route('admin.manage_service_booking')->with('success', 'Booking deleted successfully!');
    }
}
