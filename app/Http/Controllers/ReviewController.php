<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Freelancer;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create_review(Request $request, Freelancer $freelancer) {
        $review = $request->validate([
            'rating' => 'required|in: 1,2,3,4,5',
            'review' => 'required|string'
        ]);
        $review['employer_id'] = auth()->user()->id;
        $review['freelancer_id'] = $freelancer->id;

        Review::create($review);

        return response()->json(['message' => 'Review submitted']);

    }
}
