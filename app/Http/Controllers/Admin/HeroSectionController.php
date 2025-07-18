<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSection;


class HeroSectionController extends Controller
{

    public function index()
        {
            $hero = HeroSection::first(); // Only one hero section
            return view('admin.hero.index', compact('hero'));
        }

        public function store(Request $request)
        {
            $request->validate([
                'hero_title' => 'required|string',
                'hero_description' => 'required|string',
                'hero_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $data = $request->only(['hero_title', 'hero_description']);

            if ($request->hasFile('hero_image')) {
                $imageName = time().'.'.$request->hero_image->extension();
                $request->hero_image->move(public_path('storage/hero'), $imageName);
                $data['hero_image'] = $imageName;
            }

            HeroSection::create($data);

            return redirect()->route('admin.hero.index')->with('success', 'Hero section created!');
        }

        public function edit($id)
        {
            $hero = HeroSection::findOrFail($id);
            return view('admin.hero.edit', compact('hero'));
        }

        public function update(Request $request, $id)
        {
            $hero = HeroSection::findOrFail($id);

            $request->validate([
                'hero_title' => 'required|string',
                'hero_description' => 'required|string',
                'hero_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $hero->hero_title = $request->hero_title;
            $hero->hero_description = $request->hero_description;

            if ($request->hasFile('hero_image')) {
                $imageName = time().'.'.$request->hero_image->extension();
                $request->hero_image->move(public_path('storage/hero'), $imageName);
                $hero->hero_image = $imageName;
            }

            $hero->save();

            return redirect()->route('admin.hero.index')->with('success', 'Hero section updated!');
        }
}


