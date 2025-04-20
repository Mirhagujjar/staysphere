<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Storage;  

class AdminAboutUsController extends Controller
{
    public function index()
    {
        $aboutData = AboutUs::all();
        return view('admin.about.index', compact('aboutData'));
    }

    // Show the form for creating a new entry
    public function create()
    {
        return view('admin.about.create');
    }

    // Store new record in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'

        ]);

        AboutUs::create($request->all());

        return redirect()->route('admin.about.index')->with('success', 'About Us data added successfully!');
    }

    // Show the form for editing a record
    public function edit($id)
    {
        $about = AboutUs::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    // Update the record in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $about = AboutUs::findOrFail($id);
        $about->update($request->all());

        return redirect()->route('admin.about.index')->with('success', 'About Us data updated successfully!');
    }

    // Delete the record from the database
    public function destroy($id)
    {
        $about = AboutUs::findOrFail($id);
        $about->delete();

        return redirect()->route('admin.about.index')->with('success', 'About Us data deleted successfully!');
    }


}
