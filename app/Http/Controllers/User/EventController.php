<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    public function index() {
        $events = Event::all();
        return view('User.event.index', compact('events'));
    }

    public function show(Event $event) {
        return view('User.event.show', compact('events'));
    }
}
