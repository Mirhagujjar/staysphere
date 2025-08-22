<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\NotificationHelper;

class AdminReviewController extends Controller
{

    public function index()
    {
        // $reviews = Review::all();
        $reviews = Review::with(['reservation', 'user'])->get();
        return view('admin.review.index', compact('reviews'));
    }


    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->is_approved = 1;
        $review->save();

        $response =  NotificationHelper::sendNotificationWithPayload('u-'.$review->user_id, "Review Status Update", "Your review has been approved.");
    // dd($response);

        return back()->with('success', 'Review approved!');
    }


    public function reject($id)
    {
        $review = Review::findOrFail($id);
        $review->is_approved = 0;
        $review->save();

        return back()->with('error', 'Review rejected!');
    }


    public function destroy($id)
    {
        Review::destroy($id);
        return back()->with('success', 'Review deleted!');
    }
   
}
