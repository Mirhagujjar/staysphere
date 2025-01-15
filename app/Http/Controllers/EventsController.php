<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{ 
    public function index()
    {
        $events = [
            [
                'title' => 'Luxury Gala Night',
                'date' => 'March 15, 2025',
                'description' => 'Join us for an exclusive night of fine dining and live music.',
                'image' => 'event1.jpg'
            ],
            [
                'title' => 'Live Jazz Evening',
                'date' => 'April 10, 2025',
                'description' => 'Relax with a glass of wine and enjoy soothing jazz performances.',
                'image' => 'event2.jpg'
            ],
            [
                'title' => 'Wedding Expo 2025',
                'date' => 'May 5, 2025',
                'description' => 'Explore the latest wedding trends and meet top vendors.',
                'image' => 'event3.jpg'
            ]
        ];

        return view('events', compact('events'));
    }


}
