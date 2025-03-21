<?php

namespace App\Http\Controllers\Admin;  

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class AdminPackageController extends Controller {
    public function index() {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function store(Request $request) {
        Package::create($request->all());
        return redirect()->back()->with('success', 'Package added successfully!');
    }

    public function update(Request $request, $id) {
        $package = Package::findOrFail($id);
        $package->update($request->all());
        return redirect()->back()->with('success', 'Package updated successfully!');
    }

    public function destroy($id) {
        Package::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Package deleted successfully!');
    }
}

