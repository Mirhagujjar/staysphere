<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class UserReviewController extends Controller
{


    public function index()
{
    $review = Review::where('is_approved', true)->latest()->get();
    return view('user.review.review', compact('review'));
}
    public function store(Request $request)
    {

        // Validate form
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'rating' => 'required|integer',
            'comment' => 'required',
        ]);


        Review::create([
            'name' => $request->name,
            'email' => $request->email,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => 0,
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully, pending approval!');
    }
}
