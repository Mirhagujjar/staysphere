<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;

class UserAboutUsController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        return view('user.about.index', compact('about'));
    }
}
