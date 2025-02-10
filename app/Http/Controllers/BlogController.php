<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function showBlogs()
    {
        return view('blogs'); // This will load the blogs.blade.php file
    }
}
