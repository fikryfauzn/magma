<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceBookingController extends Controller
{
    public function index()
{
    // Gunakan paginasi untuk mengambil data booking
    $bookings = Booking::paginate(10); // Atau jumlah halaman yang diinginkan
    return view('admin.manage_service_booking', compact('bookings')); // Kirim ke view
}

    public function edit($booking_id)
    {
        $booking = Booking::findOrFail($booking_id); // Temukan booking berdasarkan booking_id
        $services = Service::all(); // Ambil semua data layanan untuk ditampilkan pada dropdown
        return view('admin.edit_service_booking', compact('booking', 'services')); // Arahkan ke halaman edit
    }

    public function update(Request $request, $booking_id)
    {
        // Validasi input
        $validated = $request->validate([
            'service_id' => 'required|exists:services,service_id',
            'date_scheduled' => 'required|date',
            'status' => 'required|string',
        ]);

        // Temukan booking berdasarkan booking_id
        $booking = Booking::findOrFail($booking_id);

        // Perbarui data booking
        $booking->update([
            'service_id' => $request->service_id,
            'date_scheduled' => $request->date_scheduled,
            'status' => $request->status,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.manage_service_booking')->with('success', 'Service booking updated successfully!');
    }

    public function destroy($booking_id)
    {
        $booking = Booking::findOrFail($booking_id); // Temukan booking berdasarkan booking_id
        $booking->delete(); // Hapus booking

        return redirect()->route('admin.manage_service_booking')->with('success', 'Service booking deleted successfully!');
    }
}
