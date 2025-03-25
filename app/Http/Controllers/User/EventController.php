<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    public function show(Event $event) {
        return view('event.show', compact('event'));
    }
}
