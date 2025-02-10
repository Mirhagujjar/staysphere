<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function showMenu()
    {
        return view('menu-of-the-day'); // Loads the menu-of-the-day.blade.php file
    }
}
