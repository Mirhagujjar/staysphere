<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
class UserReviewController extends Controller
{
    public function index()
{
    $reviews = Review::where('is_approved', true)->latest()->get();
    return view('user.review.review', compact('reviews'));
}
    public function store(Request $request)
    {
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
    public function showreview()
{
    // sirf approved reviews fetch ho rahe hain
    $reviews = Review::where('is_approved', 1)->latest()->get();
    return view('user.review.review', compact('review'));
}

}

// namespace App\Http\Controllers\User;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Review;
// // use App\Models\Header;
// // use App\Models\Carousel;

// class UserReviewController extends Controller
// {
//     public function index()
//     {
//         // Fetch only approved reviews and display them
//         $reviews = Review::where('is_approved', true)->latest()->get();



//         // $filters = [
//         //     'newest' => 'Newest',
//         //     'highest_rated' => 'Highest Rated',
//         //     'lowest_rated' => 'Lowest Rated',
//         // ];
//         if (request('sort') == 'highest') {
//             $reviews = $reviews->orderByDesc('rating');
//         } elseif (request('sort') == 'lowest') {
//             $reviews = $reviews->orderBy('rating');
//         } else {
//             $review = Review::where('is_approved', true)->latest()->first();

//         }



//     // $filter = $request->input('filter');

//     // if ($filter == 'newest') {
//     //     $reviews = Review::orderBy('created_at', 'desc')->get();
//     // } elseif ($filter == 'highest_rated') {
//     //     $reviews = Review::orderBy('rating', 'desc')->get();
//     // } elseif ($filter == 'most_helpful') {
//     //     $reviews = Review::where('is_approved', 1)->get();
//     // } else {
//     //     $reviews = Review::all();
//     // }

//         // Return view with reviews, header, carousel items, and filter options
//         return view('user.review.review', compact('reviews'));
//     }

//     public function store(Request $request)
//     {
//         // Validate form data
//         $request->validate([
//             'name' => 'required',
//             'email' => 'required|email',
//             'rating' => 'required|integer',
//             'comment' => 'required',
//         ]);

//         // Store the review in the database
//         Review::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'rating' => $request->rating,
//             'comment' => $request->comment,
//             'is_approved' => 0, // Review is pending approval
//         ]);

//         return redirect()->back()->with('success', 'Review submitted successfully, pending approval!');
//     }

//     public function showreview()
//     {
//         // Fetch only approved reviews
//         $reviews = Review::where('is_approved', 1)->latest()->get();

//         // Return the reviews to the view
//         return view('user.review.review', compact('reviews'));
//     }
// }
