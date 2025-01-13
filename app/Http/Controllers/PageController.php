<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function about()
    {
        return view('about');
    }
      
    public function services()
    {
        return view('services'); // This will return the services view
    }
    
    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        // Handle form submission (store data or send email)
        return back()->with('success', 'Your message has been sent!');
    } 
}
