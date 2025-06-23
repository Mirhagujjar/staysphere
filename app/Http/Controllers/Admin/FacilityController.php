<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::orderBy('sort_order')->get();
        $background = Facility::whereNotNull('background_image')->first();
        
        return view('admin.facilities.index', compact('facilities', 'background'));
    }

    public function create()
    {
        return view('admin.facilities.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'description' => 'nullable|string',
            'background_image' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        $facility = new Facility($request->except('background_image'));
        
        $this->handleBackgroundImage($request, $facility);
        
        $facility->save();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility created successfully!');
    }

    public function edit($id)
    {
        $facility = Facility::findOrFail($id);
        return view('admin.facilities.form', compact('facility'));
    }

    public function update(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'description' => 'nullable|string',
            'background_image' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        $facility->fill($request->except('background_image'));
        
        $this->handleBackgroundImage($request, $facility);
        
        $facility->save();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility updated successfully!');
    }

    public function destroy($id)
    {
        $facility = Facility::findOrFail($id);
        
        // Delete background image if this is the one being used
        if ($facility->background_image) {
            $this->deleteImage($facility->background_image);
        }
        
        $facility->delete();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility deleted successfully!');
    }

    protected function handleBackgroundImage(Request $request, Facility $facility)
    {
        if ($request->hasFile('background_image')) {
            // Delete old image if exists
            if ($facility->background_image) {
                $this->deleteImage($facility->background_image);
            }
            
            $path = $request->file('background_image')
                ->store('facilities/background', 'public');
                
            $facility->background_image = $path;
        } elseif ($request->has('remove_background')) {
            // Handle background image removal
            if ($facility->background_image) {
                $this->deleteImage($facility->background_image);
                $facility->background_image = null;
            }
        }
    }

    protected function deleteImage($path)
    {
        $fullPath = storage_path('app/public/' . $path);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }
    
    // Add this method to handle background image separately
    public function updateBackground(Request $request)
    {
        $request->validate([
            'background_image' => 'required|image|max:2048'
        ]);
        
        // Delete any existing background images
        Facility::whereNotNull('background_image')
            ->get()
            ->each(function($facility) {
                $this->deleteImage($facility->background_image);
                $facility->background_image = null;
                $facility->save();
            });
        
        // Store new background image on a random facility
        $facility = Facility::inRandomOrder()->first();
        $this->handleBackgroundImage($request, $facility);
        $facility->save();
        
        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facilities background updated successfully!');
    }
}