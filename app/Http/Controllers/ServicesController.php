<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Services;

class ServicesController extends Controller
{
    public function showServices()
    {
        $services = Services::all(); // Get all services from DB
        return view('services.index', compact('services'));
    }

    public function showServiceDetails($id)
    {
        $services = Services::findOrFail($id);
        return view('services.details', compact('services'));
    }
}
