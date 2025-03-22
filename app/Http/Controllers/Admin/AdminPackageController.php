<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

use Illuminate\Support\Facades\Storage;


class AdminPackageController extends Controller {
    public function index() {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Package::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName
        ]);

        return redirect()->back()->with('success', 'Package added successfully!');
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'regular_price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);
    
        $package->name = $request->name;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->regular_price = $request->regular_price;
    
        if ($request->hasFile('image')) {
            // Purani image delete
            if ($package->image) {
                Storage::delete('public/packages/' . $package->image);
            }
            // Nayi image upload
            $imagePath = $request->file('image')->store('public/packages');
            $package->image = basename($imagePath);
        }
    
        $package->save();
    
        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }
    

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return redirect()->route('admin.packages')->with('success', 'Package deleted successfully!');
    }

}
