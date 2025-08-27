<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSlider;
use App\Models\AboutUs;
use App\Models\TeamMember;

class HomeController extends Controller
{
    
     public function index()
    {
        $sliders = HomeSlider::orderBy('order', 'asc')->get();
        $about = AboutUs::first(); 
        $teamMembers = TeamMember::all();


        return view('home', compact(
            'sliders',
            'about',
            'teamMembers'
        ));
    }
}



// class HomeController extends Controller
// {
//     /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         $this->middleware('auth');
//     }

//     /**
//      * Show the application dashboard.
//      *
//      * @return \Illuminate\Contracts\Support\Renderable
//      */
//     public function index()
//     {
//         return view('home');
//     }
// }
