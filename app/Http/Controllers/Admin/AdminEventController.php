<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class AdminEventController extends Controller
{


        // 🟢 Show All Events
        public function index()
        {
            $events = Event::all();
            return view('admin.event.index', compact('events'));
        }

        // 🟢 Show Create Event Form
        public function create()
        {
            return view('admin.event.create');
        }

        // 🟢 Store Event in Database
        public function store(Request $request)
        {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'event_date' => 'required|date',
                'location' => 'required',
                'image' => 'nullable|image|max:2048'
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('events', 'public');
            }

            Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'event_date' => $request->event_date,
                'location' => $request->location,
                'image' => $imagePath
            ]);

            return redirect()->route('admin.events')->with('success', 'Event Added Successfully!');
        }

        // 🟢 Show Edit Form
        public function edit($id)
        {
            $event = Event::findOrFail($id);
            return view('admin.event.edit', compact('event'));
        }

        // 🟢 Update Event
        public function update(Request $request, $id)
        {
            $event = Event::findOrFail($id);
            $event->update($request->all());

            return redirect()->route('admin.events')->with('success', 'Event Updated Successfully!');
        }

        // 🟢 Delete Event
        public function destroy($id)
        {
            Event::destroy($id);
            return redirect()->route('admin.events')->with('success', 'Event Deleted Successfully!');
        }
    }


