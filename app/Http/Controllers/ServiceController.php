<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all(); // Ambil semua data dari tabel services
        return view('admin.manage_services', compact('services')); // Kirim data ke view
    }

    public function edit($service_id)
    {
        // Temukan layanan berdasarkan service_id
        $service = Service::where('service_id', $service_id)->firstOrFail(); 

        return view('admin.edit_service', compact('service')); // Arahkan ke form edit
    }

    public function update(Request $request, $service_id)
    {
        // Temukan layanan berdasarkan service_id
        $service = Service::where('service_id', $service_id)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // Update data layanan
        $service->update([
            'service_name' => $validated['service_name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
        ]);

        return redirect()->route('admin.manage_services')->with('success', 'Service updated successfully!');
    }


    public function destroy($service_id)
{
    try {
        // Cari layanan berdasarkan service_id
        $service = Service::where('service_id', $service_id)->first();

        if (!$service) {
            return redirect()->route('admin.manage_services')->with('error', 'Service not found.');
        }

        // Debug untuk memastikan data ditemukan
        \Log::info('Deleting service: ', $service->toArray());

        // Hapus layanan
        $service->delete();

        return redirect()->route('admin.manage_services')->with('success', 'Service deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->route('admin.manage_services')->with('error', 'Failed to delete service: ' . $e->getMessage());
    }
}


}
