<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSection;


class HeroSectionController extends Controller
{




    public function store(Request $request)
{
    $data = $request->validate([
        'hero_title' => 'nullable|string',
        'hero_description' => 'nullable|string',
        'hero_image' => 'nullable|image'
    ]);

    if ($request->hasFile('hero_image')) {
        $data['hero_image'] = $request->file('hero_image')->store('hero', 'public');
    }

    HeroSection::create($data);

    return back()->with('success', 'Hero Section Added');
}

public function destroy($id)
{
    HeroSection::destroy($id);
    return back()->with('success', 'Hero Section Deleted');
}

}


