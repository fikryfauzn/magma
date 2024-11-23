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
}
