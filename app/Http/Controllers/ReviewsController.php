<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function showreviews()
    {
        return view('reviews'); // This will return the FAQ view
    }
}
