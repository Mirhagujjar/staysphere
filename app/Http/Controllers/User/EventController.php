<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExperienceCard;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        // sab events fetch karo
        $events = Event::all();
        $experiences = ExperienceCard::all(); // fetch experiences

        // view ko bhejo
        return view('events', compact('events', 'experiences'));
    }
}

