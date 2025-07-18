<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\ServiceRequestStatusUpdated;


class UserServiceRequestController extends Controller
{
    public function myRequests()
    {
        
        $requests = auth()->user()->serviceRequests()->latest()->get();
        return view('user.my_requests', compact('requests'));
    }

}
