<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;


class AdminAboutUsController extends Controller
{

        public function index()
        {
            $about = AboutUs::first();
            return view('admin.about.index', compact('about'));
        }

        public function create()
        {
            return view('admin.about.create');
        }

        public function store(Request $request)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $about = new AboutUs();
            $about->title = $request->title;
            $about->description = $request->description;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('about_images', 'public');
                $about->image = $imagePath;
            }

            $about->save();

            return redirect()->route('admin.about.index')->with('success', 'About Us created successfully.');
        }

        public function edit()
        {
            $about = AboutUs::first();
            return view('admin.about.edit', compact('about'));
        }

        public function update(Request $request)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $about = AboutUs::first();

            if (!$about) {
                $about = new AboutUs();
            }

            $about->title = $request->title;
            $about->description = $request->description;

            if ($request->hasFile('image')) {
                Storage::delete('public/' . $about->image);
                $imagePath = $request->file('image')->store('about_images', 'public');
                $about->image = $imagePath;
            }

            $about->save();

            return redirect()->route('admin.about.index')->with('success', 'About Us updated successfully.');
        }

        public function destroy()
        {
            AboutUs::truncate();
            return redirect()->route('admin.about.index')->with('success', 'About Us deleted successfully.');
        }
    }


