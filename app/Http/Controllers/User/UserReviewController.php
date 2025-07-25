<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserReviewController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to submit reviews.');
        }

        // Get completed bookings that haven't been reviewed yet
        // Alternative approach in controller
        $completedBookings = Reservation::where('user_id', $user->id)
            ->where('status', 'checked_out')
            ->whereDoesntHave('review')
            ->latest()
            ->get();

        // Get approved reviews with eager loading
        $reviews = Review::with(['user', 'reservation'])
            ->where('is_approved', true)
            ->latest()
            ->paginate(10);

        return view('user.review.review', compact('reviews', 'completedBookings'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to submit reviews.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|min:10|max:1000',
            'reservation_id' => 'required|exists:reservations,id',
            'consent' => 'required|accepted'
        ]);

        // Verify the reservation belongs to the user and is completed
        $reservation = Reservation::where('id', $validated['reservation_id'])
            ->where('user_id', $user->id)
            ->where('status', 'checked_out')
            ->first();

        if (!$reservation) {
            return back()
                ->withInput()
                ->with('error', 'Invalid or incomplete booking selected.');
        }

        // Check if review already exists for this reservation
        if ($reservation->review()->exists()) {
            return back()
                ->withInput()
                ->with('error', 'You have already submitted a review for this booking.');
        }

        // Create the review
        Review::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => false,
            'reservation_id' => $reservation->id,
            'user_id' => $user->id,
        ]);

        return redirect()
            ->route('user.reviews.review')
            ->with('success', 'Thank you! Your review has been submitted and is pending approval.');
    }
}