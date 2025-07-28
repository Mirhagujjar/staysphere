<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class AdminEventController extends Controller
{
    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'event_date' => 'required|date',
        'location' => 'nullable|string',
        'image' => 'nullable|image'
    ]);

    // if ($request->hasFile('image')) {
    //     $data['image'] = $request->file('image')->store('events', 'public');
    // }
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('events', 'public');
        $data['image'] = $imagePath;
    }


    Event::create($data);
    return back()->with('success', 'Event Added');
}

public function destroy($id)
{
    Event::destroy($id);
    return back()->with('success', 'Event Deleted');
}

}
