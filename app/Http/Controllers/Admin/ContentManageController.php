<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\HeroSection;
use App\Models\ExperienceCard;

class ContentManageController extends Controller
{



    public function index()
    {
        $hero = HeroSection::latest()->first();
        $experiences = ExperienceCard::all();
        $events = Event::all();

        return view('admin.events.index', compact('hero', 'experiences', 'events'));
    }


}
