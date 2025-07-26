<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSection;
use App\Models\ExperienceCard;
use App\Models\Event;

class EventPageController extends Controller
{


        public function index()
        {
            $hero = HeroSection::latest()->first(); // single hero
            $experiences = ExperienceCard::all();
            $events = Event::all();

            return view('admin.events.create', compact('hero', 'experiences', 'events'));
        }

}
