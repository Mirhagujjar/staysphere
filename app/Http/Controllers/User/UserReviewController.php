<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
class UserReviewController extends Controller
{
    public function index()
{
    $user = auth()->user();

    if (!$user) {
        abort(403, 'You must be logged in.');
    }

    $completedBookings = $user->reservations()
        ->where('status', 'completed')
        ->get();

    // agar kuch nahi mila to empty collection bhejo
    if ($completedBookings->isEmpty()) {
        $completedBookings = collect();
    }
    $reviews = Review::where('is_approved', true)->latest()->get();
    return view('user.review.review', compact('reviews','completedBookings'));
}
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'rating' => 'required|integer',
            'comment' => 'required',
            'reservation_id' => 'required|exists:reservations,id',
        ]);
        $reservation = auth()->user()->reservations()
        ->where('id', $request->reservation_id)
        ->where('status', 'completed')
        ->first();

    if (!$reservation) {
        return back()->with('error', 'Invalid or incomplete booking.');
    }

    $alreadyReviewed = Review::where('reservation_id', $reservation->id)->exists();

    if ($alreadyReviewed) {
        return back()->with('error', 'You have already submitted a review for this booking.');
    }



        Review::create([
            'name' => $request->name,
            'email' => $request->email,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => 0,
            'reservation_id' => $reservation->id,
            'user_id' => auth()->id(),
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
