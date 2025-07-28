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
        $hero = Service::first();
        return view('admin.services.index', compact('services', 'hero'));
    }

    public function updateHero(Request $request)
    {
        $data = $request->only(['hero_title', 'hero_subtitle']);

        if ($request->hasFile('hero_background')) {
            $data['hero_background'] = $this->handleImageUpload($request, 'hero_background', 'services/hero');
        }

        $hero = Service::firstOrNew([]);
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
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'detail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facilities' => 'nullable|string',
            'modal_button_text' => 'nullable|string',
            'modal_fields' => 'required|string',
        ]);

        $data = $request->only([
            'title', 'short_description', 'long_description', 'price', 'modal_button_text'
        ]);

        try {
            $data['facilities'] = $this->cleanFacilitiesInput($request->input('facilities'));
            $data['modal_fields'] = $this->parseModalFields($request->input('modal_fields'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['modal_fields' => 'Invalid format for modal fields']);
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->handleImageUpload($request, 'thumbnail', 'services/thumbnails');
        }

        if ($request->hasFile('detail_image')) {
            $data['detail_image'] = $this->handleImageUpload($request, 'detail_image', 'services/details');
        }

        $data['slug'] = Str::slug($data['title']) . '-' . uniqid();

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
            'modal_button_text' => 'nullable|string|max:255',
            'facilities' => 'nullable|string',
            'modal_fields' => 'required|string',
        ]);

        $data = $request->only([
            'title', 'slug', 'short_description', 'long_description', 
            'price', 'modal_button_text'
        ]);

        try {
            $data['facilities'] = $this->cleanFacilitiesInput($request->input('facilities'));
            $data['modal_fields'] = $this->parseModalFields($request->input('modal_fields'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['modal_fields' => 'Invalid format for modal fields']);
        }

        if ($request->hasFile('thumbnail')) {
            $this->deleteImageIfExists($service->thumbnail);
            $data['thumbnail'] = $this->handleImageUpload($request, 'thumbnail', 'services/thumbnails');
        }

        if ($request->hasFile('detail_image')) {
            $this->deleteImageIfExists($service->detail_image);
            $data['detail_image'] = $this->handleImageUpload($request, 'detail_image', 'services/details');
        }

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $this->deleteImageIfExists($service->thumbnail);
        $this->deleteImageIfExists($service->detail_image);
        $this->deleteImageIfExists($service->hero_background);
        
        $service->delete();
        
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    // Helper Methods
    private function cleanFacilitiesInput($input)
    {
        if (empty($input)) {
            return [];
        }

        $facilities = preg_split('/\r\n|[\r\n,]/', $input);
        
        return array_values(array_filter(array_map(function($item) {
            $cleaned = trim($item, " \t\n\r\0\x0B\"'[]");
            return !empty($cleaned) ? $cleaned : null;
        }, $facilities)));
    }

    private function parseModalFields($input)
    {
        if (is_array($input)) {
            return $input;
        }

        $decoded = json_decode($input, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $lines = preg_split('/\r\n|[\r\n]/', $input);
            $fields = [];
            
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    $fields[] = $line;
                }
            }
            
            return $fields;
        }
        
        return $decoded;
    }

    private function handleImageUpload($request, $fieldName, $storagePath)
    {
        if (!$request->hasFile($fieldName)) {
            return null;
        }

        return $request->file($fieldName)->store($storagePath, 'public');
    }

    private function deleteImageIfExists($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}