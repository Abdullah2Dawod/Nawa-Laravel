<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use NumberFormatter;

class ProductsController extends Controller
{
    public function index()
    {
    }

    public function show($slug)
    {
        $cookie_id = request()->cookie('cart_id');
        $query = Cart::query();

        if ($cookie_id) {
         $query->where('user_id', '=', Auth::id())
          ->where('cookie_id', '=', $cookie_id);
        }

          $cart = $query->get();
          $total = $cart->sum(function($item) {
            return $item->product->price * $item->quantity;
         });
         $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);


        $product = Product::active()->withoutGlobalScope('owner')
        ->where('slug' , '=' , $slug)
        ->firstOrFail();

        $gallery = ProductImage::Where('product_id', '=', $product->id)->get();

        return view('shop.products.show' , [
            'product' => $product,
            'gallery' => $gallery,
            'cart' => $cart,
            'total' => $formatter->formatCurrency($total, 'ILS'),

        ]);
    }
}
