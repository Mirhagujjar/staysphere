<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\ServiceRequestStatusUpdated;
use App\Models\ServiceRequest;
use App\Models\Services;
use Illuminate\Support\Facades\Auth;


class UserServiceRequestController extends Controller
{
    public function myRequests()
    {
        // $requests = Auth::user()->serviceRequests()->latest()->get();

        $requests = Auth::user()->serviceRequests;
        return view('user.my_requests', compact('requests'));
    }

}
