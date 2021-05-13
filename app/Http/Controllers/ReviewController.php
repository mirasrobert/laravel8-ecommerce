<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Add Reviews
    public function store($id, ReviewRequest $request)
    {
        auth()->user()->reviews()->create([
            'product_id' => $id,
            'comment' => $request->review,
            'rate' => $request->rating
        ]);

        return back()->with('status', 'Your review has been added.');
    }
}
