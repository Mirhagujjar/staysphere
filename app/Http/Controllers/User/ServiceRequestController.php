<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Auth;

class ServiceRequestController extends Controller
{
// Show form
    public function create()
    {
        $services = Service::all();
        return view('user.bookingservices.create', compact('services'));
    }

    // Handle form submit
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'room_number' => 'required|string|max:10',
            'service_id' => 'required|exists:services,id',
            'notes' => 'nullable|string',
        ]);

        $validated['status'] = 'pending';
        $validated['user_id'] = Auth::id(); // logged-in user

        ServiceRequest::create($validated);

        return redirect()->route('user.services.create')->with('success', 'Service request submitted successfully!');
    }
    public function index()
    {
        $requests = \App\Models\ServiceRequest::with('service')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('user.bookingservices.index', compact('requests'));
    }

}


