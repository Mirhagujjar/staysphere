<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('id', 'desc')->get();
        $hero = Service::first(); // can also be fetched via a separate model if needed
        return view('admin.services.index', compact('services', 'hero'));
    }

    public function updateHero(Request $request)
    {
        $data = $request->only(['hero_title', 'hero_subtitle']);

        if ($request->hasFile('hero_background')) {
            $data['hero_background'] = $request->file('hero_background')->store('services/hero', 'public');
        }

        $hero = Service::first();

        if (!$hero) {
            // Create a placeholder service if none exists
            $hero = new Service();
            $hero->title = 'Default Hero';
            $hero->slug = 'default-hero-' . uniqid();
            $hero->short_description = 'Default';
            $hero->long_description = 'Default';
            $hero->price = '0';
            $hero->modal_fields = [];
        }

        $hero->fill($data)->save();

        return redirect()->back()->with('success', 'Hero section updated successfully.');
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'long_description' => 'required|string',
            'price' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'detail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'facilities' => 'nullable|string', // comma-separated string
            'modal_button_text' => 'nullable|string',
            'modal_fields' => 'required|string', // JSON string
        ]);

        $data = $request->only([
            'title', 'short_description', 'long_description', 'price', 'modal_button_text'
        ]);

        // Convert comma-separated facilities to array
        $data['facilities'] = array_map('trim', explode(',', $request->input('facilities', '')));

        // Decode modal fields JSON
        $data['modal_fields'] = json_decode($request->input('modal_fields'), true);

        // Handle images
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('services/thumbnails', 'public');
        }

        if ($request->hasFile('detail_image')) {
            $data['detail_image'] = $request->file('detail_image')->store('services/details', 'public');
        }

        // Save to DB
        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }




    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:services,slug,' . $service->id,
            'short_description' => 'required|string|max:500',
            'long_description' => 'required|string',
            'price' => 'required|string|max:50',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_background' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'modal_button_text' => 'nullable|string|max:255',
            'facilities' => 'nullable|string',
            'modal_fields' => 'required|string', // string to parse
        ]);

        $data = $request->except(['thumbnail', 'detail_image']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('services/thumbnails', 'public');
        }

        if ($request->hasFile('detail_image')) {
            $data['detail_image'] = $request->file('detail_image')->store('services/details', 'public');
        }

        if ($request->hasFile('hero_background')) {
            $data['hero_background'] = $request->file('hero_background')->store('services/hero', 'public');
        }

       // Before saving to database, convert comma-separated string into array, then to JSON:
        if ($request->has('facilities')) {
            $facilitiesArray = explode(',', $request->input('facilities'));
            $data['facilities'] = json_encode(array_map('trim', $facilitiesArray));
        } else {
            $data['facilities'] = json_encode([]);
        }


        $data['modal_fields'] = json_decode($request->input('modal_fields'), true);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
