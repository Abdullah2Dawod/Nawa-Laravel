<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class ProductsController extends Controller
{
    public function index()
    {
    }

    public function show($slug)
    {
        $product = Product::active()->withoutGlobalScope('owner')
        ->where('slug' , '=' , $slug)
        ->firstOrFail();

        $gallery = ProductImage::Where('product_id', '=', $product->id)->get();

        return view('shop.products.show' , [
            'product' => $product,
            'gallery' => $gallery,
        ]);
    }
}
