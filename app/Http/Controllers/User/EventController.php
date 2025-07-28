<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExperienceCard;
use App\Models\HeroSection; // Add this

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        // sab events fetch karo
        $events = Event::all();
        $experiences = ExperienceCard::all(); // fetch experiences
        $hero = HeroSection::latest()->first(); // 👈 Fetch latest hero section

        // view ko bhejo
        return view('events', compact('events', 'experiences', 'hero'));
    }
}

