<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeaderReview;
use Illuminate\Http\Request;

class AdminHeaderReviewController extends Controller
{
    public function create()
    {
        return view('admin.review.header.header_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image',
        ]);

        $imagePath = $request->file('image')->store('headers', 'public');

        HeaderReview::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Header added successfully.');
    }

    public function edit($id)
    {
        $headers = HeaderReview::findOrFail($id);
        return view('admin.review.header.header_edit', compact('headers'));
    }

    public function update(Request $request, $id)
    {
        $headers = HeaderReview::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('headers', 'public');
        }

        $headers->update($data);

        return redirect()->back()->with('success', 'Header updated successfully.');
    }
}
