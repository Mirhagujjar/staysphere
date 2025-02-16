<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog()
    {
        return view('blog.blog');
    }
    public function topRoom()
{
    return view('blog.topRoom');
}

    public function chefSpecial()
    {
        return view('blog.chefSpecial');
    }

    public function guest()
    {
        return view('blog.guest');
    }

    public function hosting()
    {
        return view('blog.hosting');
    }

}
