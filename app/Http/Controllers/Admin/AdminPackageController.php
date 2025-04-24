<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageBooking;
use Illuminate\Support\Facades\File;

class AdminPackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $packages = Package::all();
        return view('admin.packages.create', compact('packages'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
        ]);
        
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('assets/images/packages'), $imageName);

        Package::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Package added successfully!');
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $package->name = $request->name;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->regular_price = $request->regular_price;

        if ($request->hasFile('image')) {
            //   remove old img
            $oldImagePath = public_path('assets/images/packages/' . $package->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // New image upload
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/images/packages'), $imageName);
            $package->image = $imageName;
        }

        $package->save();

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);

        // Delete image from folder too
        $imagePath = public_path('assets/images/packages/' . $package->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully!');
    }
}
