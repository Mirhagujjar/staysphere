<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class AdminReviewController extends Controller
{
    public function index()
    {
        $review = Review::all();
        return view('admin.review.index', compact('review'));
    }

    public function approve($id)
{
    $review = Review::findOrFail($id);
    $review->is_approved = 1; // approved
    $review->save();

    return back()->with('success', 'Review approved!');
}

public function reject($id)
{
    $review = Review::findOrFail($id);
    $review->is_approved = 0; // rejected
    $review->save();

    return back()->with('error', 'Review rejected!');
}
    public function destroy($id)
    {
        Review::destroy($id);
        return back()->with('success', 'Review deleted!');
    }
}
