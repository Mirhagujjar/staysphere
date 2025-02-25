<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Services;

class ServicesController extends Controller
{
    public function showServices()
    {
        return view('services.index');
    }

   
    
    public function showhousekeepingDetails()
    {
        return view('services.housekeeping');

    }

    // public function showDiningDetails()
    // {
    //     return view('services.Dining');

    // }
    public function showFitnessDetails()
    {
        return view('services.Fitness');

    }
    // public function showConferenceDetails()
    // {
    //     return view('services.Conference');

    // }
    public function showSecurityDetails()
    {
        return view('services.Security');

    }
}
