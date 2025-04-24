<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HeaderReview;
use Illuminate\Http\Request;

class HeaderReviewController extends Controller
{
    public function showHeader()
    {
        $headers = HeaderReview::latest()->first();
        return view('user.review.review', compact('headers'));
    }
}
