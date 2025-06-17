<?php

// app/Http/Controllers/User/AboutUsController.php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\TeamMember;
use App\Models\Faq;

class AboutUsController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        $teamMembers = TeamMember::orderBy('order')->get();
        $faqs = Faq::orderBy('order')->get();
        
        return view('user.about.index', compact('about', 'teamMembers', 'faqs'));
    }
}