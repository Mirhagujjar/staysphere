<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class AdminEventController extends Controller
{
    public function index() {
        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }

    public function create() {
        return view('admin.event.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        Event::create($request->all());
        return redirect()->route('admin.event.index')->with('success', 'Event Created Successfully!');
    }

    public function edit(Event $event) {
        return view('admin.event.edit', compact('event'));
    }
    public function update(Request $request, Event $event) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $event->update($request->all());
        return redirect()->route('admin.event.index')->with('success', 'Event Updated Successfully!');
    }

    public function destroy(Event $event) {
        $event->delete();
        return redirect()->route('admin.event.index')->with('success', 'Event Deleted Successfully!');
    }

    public function index1()
    {
        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }

    public function create1()
    {
        return view('admin.event.create');
    }
}
