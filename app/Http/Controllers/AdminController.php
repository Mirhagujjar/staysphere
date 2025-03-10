<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
     // Admin dashboard
     public function dashboard()
     {
         return view('admin.dashboard');
     }

     public function index()
{
    // Fetch data from the database if needed
    return view('admin.reservations.reservations_list');
}
 
     // Manage users
    //  public function users()
    //  {
    //      return view('admin.users');
    //  }
 
     // Manage bookings
    //  public function bookings()
    //  {
    //      return view('admin.bookings');
    //  }
}
