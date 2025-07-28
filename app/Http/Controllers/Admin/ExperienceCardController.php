<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExperienceCard;
class ExperienceCardController extends Controller
{
    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'image' => 'nullable|image'
    ]);

    // if ($request->hasFile('image')) {
    //     $data['image'] = $request->file('image')->store('experiences', 'public');
    // }
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('events/experiences', 'public');
    }


    ExperienceCard::create($data);
    return back()->with('success', 'Experience Card Added');
}

public function destroy($id)
{
    ExperienceCard::destroy($id);
    return back()->with('success', 'Card Deleted');
}

}
