<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function get_reviews()
    {
        $reviews = Review::where('show', 1)->with('user')->latest()->get();

        return response()->json([
            'status' => 'success',
            'reviews' => $reviews
        ]);
    }

    public function store(Request $request)
    {
        $review = Review::create([
            'user_id' => auth()->user()->id,
            'stars' => $request->stars,
            'review' => $request->review,
            'show' => 0
        ]);

        return response()->json([
            'stauts' => 'success',
            'message' => 'review saved successfully'
        ]);
    }

    public function dashboard_review()
    {
        $reviews = Review::with('user')->latest()->paginate(25);

        return  view('pages.reviews.index', compact('reviews'));
    }

    public function update_review(Review $review)
    {
        if ($review->show == 0 || $review->show == null) {
            $review->update([
                'show' => 1
            ]);
        } else {
            $review->update([
                'show' => 0
            ]);
        }

        return  redirect()->route('show reviews');
    }

    public function destroy(Request $request, Review $review)
    {
        $review->delete();

        return redirect()->route('show reviews')->with('success', 'تم حذف التقييم بنجاح');
    }
}
