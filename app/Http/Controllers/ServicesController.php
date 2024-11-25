<?php
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    // Show all available services
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    // Show a single service's details
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('services.show', compact('service'));
    }
}
