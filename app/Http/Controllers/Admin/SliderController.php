<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    // Show all sliders
    public function index()
    {
        $sliders = HomeSlider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    // Show create form
    public function create()
    {
        return view('admin.sliders.create');
    }

    // Store new slider
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'order' => 'nullable|integer'
        ]);
         $imageName = time().'.'.$request->image->extension();
    $request->image->move(public_path('assets/images/home'), $imageName);
        HomeSlider::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => 'assets/images/home/'.$imageName,
            // 'image' => $imagePath,
            'order' => $request->order ?? 0
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider added!');
    }

    // Delete slider
    public function destroy($id)
    {
        $slider = HomeSlider::findOrFail($id);
        Storage::disk('public')->delete($slider->image);
        $slider->delete();
        return back()->with('success', 'Slider deleted!');
    }
    // Show edit form
public function edit($id)
{
    $slider = HomeSlider::findOrFail($id);
    return view('admin.sliders.edit', compact('slider'));
}

// Update slider
public function update(Request $request, $id)
{
    $slider = HomeSlider::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'order' => 'nullable|integer'
    ]);

    $data = [
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'order' => $request->order ?? $slider->order
    ];

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('assets/images/home'), $imageName);
        // Delete old image if needed
        $oldImage = HomeSlider::find($id)->image;
        if (file_exists(public_path($oldImage))) {
            unlink(public_path($oldImage));
        }
        // Update new path
        $data['image'] = 'assets/images/home/'.$imageName;
    }


    $slider->update($data);

    return redirect()->route('admin.sliders.index')->with('success', 'Slider updated!');
}
}
