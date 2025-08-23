<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;
 use App\Models\User;
use App\Notifications\ServiceRequestStatusUpdated;
use App\Models\NotificationHelper;


class ServiceRequestController extends Controller
{
    public function index()
    {
        $requests = ServiceRequest::with('service')->latest()->get();
        $totalServiceRequests = ServiceRequest::count();

        return view('admin.service_requests.index', compact('requests', 'totalServiceRequests'));
    }

 

public function updateStatus(Request $request, $id)
{
    $serviceRequest = ServiceRequest::findOrFail($id);
    $serviceRequest->status = $request->input('status');
    $serviceRequest->save();

    // 🔑 SAFEST WAY
    $user = User::where('email', $serviceRequest->email)->first();
    if ($user) {
        $user->notify(new ServiceRequestStatusUpdated($serviceRequest));
    } else {
        // Debug karo
        logger('User not found for email: ' . $serviceRequest->email);
    }
    $response =  NotificationHelper::sendNotificationWithPayload('u-'.$serviceRequest->user_id, "Service Request Status Update", "Your service request is now ".$request->status);

    return redirect()->back()->with('success', 'Status updated and user notified.');
}



}

