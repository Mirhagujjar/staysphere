<?php

namespace App\Http\Controllers\User; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageBooking;

class UserPackageController extends Controller {
    public function index() {
        $packages = Package::all();
        return view('user.packages.index', compact('packages'));
    }

    // public function book(Request $request) {
        
    // }
}

