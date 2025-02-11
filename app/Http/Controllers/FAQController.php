<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function showFAQ()
    {
        return view('faq'); // This will return the FAQ view
    }
}
