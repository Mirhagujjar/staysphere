<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class UserServiceController extends Controller
{
    /**
     * Display all services on the main services page.
     */
    public function index()
    {
        $services = Service::orderBy('id', 'desc')->get();

        return view('user.services.index', compact('services'));
    }

    /**
     * Display details of a specific service.
     */
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $service->facilities = explode(',', $service->facilities);

        $otherServices = Service::where('slug', '!=', $slug)->latest()->get();

        return view('User.services.show', compact('service', 'otherServices'));
    }

    // public function create()
    // {
    //     $services = \App\Models\Service::all(); // sab services lao
    //     return view('User.services.request', compact('services'));
    // }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'room_number' => 'required',
            'service_id' => 'required|exists:services,id',
            'notes' => 'nullable',
        ]);

        // Yahan tum apni ServiceRequest ya Reservation table me save karo
        \App\Models\ServiceRequest::create($validated);

        return back()->with('success', 'Your service request has been submitted successfully.');
    }


}
