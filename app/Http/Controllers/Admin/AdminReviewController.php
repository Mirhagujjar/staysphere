<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
// use App\Models\Header; // If header is a separate model
// use App\Models\Carousel; // If carousel is a separate model

class AdminReviewController extends Controller
{
    // Display all reviews, headers, and carousels
    public function index()
    {
        $reviews = Review::all(); // Fetch all reviews (with approval logic)
        $headers = Review::all(); // Fetch all headers (no approval)
        $carouselItems =Review::all(); // Fetch all carousels (no approval)

        return view('admin.review.index', compact('reviews', 'headers', 'carouselItems'));
    }

    // Approve a review
    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->is_approved = 1; // Approved
        $review->save();

        return back()->with('success', 'Review approved!');
    }

    // Reject a review
    public function reject($id)
    {
        $review = Review::findOrFail($id);
        $review->is_approved = 0; // Rejected
        $review->save();

        return back()->with('error', 'Review rejected!');
    }

    // Delete a review
    public function destroy($id)
    {
        Review::destroy($id);
        return back()->with('success', 'Review deleted!');
    }
}

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Review;

// class AdminReviewController extends Controller
// {
//     public function index()
//     {
//         $review = Review::all();
//         return view('admin.review.index', compact('review'));
//     }

//     public function approve($id)
// {
//     $review = Review::findOrFail($id);
//     $review->is_approved = 1; // approved
//     $review->save();

//     return back()->with('success', 'Review approved!');
// }

// public function reject($id)
// {
//     $review = Review::findOrFail($id);
//     $review->is_approved = 0; // rejected
//     $review->save();

//     return back()->with('error', 'Review rejected!');
// }
//     public function destroy($id)
//     {
//         Review::destroy($id);
//         return back()->with('success', 'Review deleted!');
//     }
// }
