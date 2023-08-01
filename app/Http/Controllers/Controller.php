<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use NumberFormatter;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function __construct(Request $request)
    {
        $cookie_id = $request->cookie('cart_id');
        $cart = Cart::with('product')->where('cookie_id', '=', $cookie_id)->get();
        $reviews = Review::simplePaginate(3);
        $categories = Category::get();

        $total = $cart->sum(function($item) {
            return $item->product->price * $item->quantity;
         });

        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);

        $cart = Cart::all();
        View::share([
            "cart" => $cart,
            'total' => $formatter->formatCurrency($total, 'ILS'),
            'reviews' => $reviews,
            'categories' => $categories,
        ]);
    }
}
