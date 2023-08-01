<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        // $product = Product::find($id);
        // // dd($request->all());
        // $review = Review::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'subject' => $request->subject,
        //     'rating' => $request->rating,
        //     'description' => $request->description,
        //     'product_id' => $product
        // ]);

        $review = new  Review();

        $review->name = $request->name;
        $review->email = $request->email;
        $review->rating = $request->rating;
        $review->subject = $request->subject;
        $review->description = $request->description;
        $review->product_id = $request->product_id;
        // $review->associate($product);
        // $review->product->associate($product);

        $review->save();
        $product = Product::find($id = 'product_id');
        // $product->save();
        dd($product);


        // $review = Review::create($request->validated());


        return back()
            ->with('success', "Your review has been submitted successfully, thank you!!");
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
