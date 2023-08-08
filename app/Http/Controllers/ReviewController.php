<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $reviews = Review::simplePaginate();
        // return view('shop.products.show', [
        //     'reviews' => $reviews,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shop.products.show', [
            'review' => new Review(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request, $id)
    {

        if (Auth::check()) {
            $review = Review::create($request->validated());
            $review->save();

            return back()
                ->with('success', "Your review has been submitted successfully, thank you!!");
        } else {
            return redirect()->route('register');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
