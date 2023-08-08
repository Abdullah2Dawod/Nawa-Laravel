<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Messages;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

use NumberFormatter;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $cookie_id = $request->cookie('cart_id');
        $cart = Cart::with('product')->get();
        // ->where('user_id', '=', Auth::id())
        // ->where('cookie_id', '=', $cookie_id)->get();

        $total = $cart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $price_large_products = Product::where('price', '>=', 1000)->get();

        $moreQuantitativeProducts = Product::orderByMoreQuantity()->get();
        $lessQuantitativeProducts = Product::OrderByLessQuantity()->get();
        $addNewProducts = Product::orderByNewProduct()->get();
        // $topSellingProducts = Cart::topSelling(5)->with('product')->get();

        $mobiles = 'Mobiles';
        // $mixers = 'Mixers';

        $products_mobiles = Product::with('category')->byCategoryType($mobiles)->get();


        $products = Product::withoutGlobalScope('owner')
            ->with('category')  //Eager loud
            // ->active()
            // ->latest('updated_at')
            ->get();

        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);

        return view('homepage.home', [
            'products' => $products,
            'cart' => $cart,
            'products_mobiles' => $products_mobiles,
            'price_large_products' => $price_large_products,
            'moreQuantitativeProducts' => $moreQuantitativeProducts,
            'lessQuantitativeProducts' => $lessQuantitativeProducts,
            'addNewProducts' => $addNewProducts,
            'total' => $formatter->formatCurrency($total, 'ILS'),
        ]);
    }

    public function about()
    {
        $cookie_id = request()->cookie('cart_id');
        $query = Cart::query();

        if ($cookie_id) {
            $query->where('user_id', '=', Auth::id())
                ->where('cookie_id', '=', $cookie_id);
        }

        $cart = $query->get();

        $total = $cart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);


        return view('homepage.about', [
            'cart' => $cart,
            'total' => $formatter->formatCurrency($total, 'ILS'),
        ]);
    }

    public function index_contact()
    {
        $cookie_id = request()->cookie('cart_id');
        $query = Cart::query();

        if ($cookie_id) {
            $query->where('user_id', '=', Auth::id())
                ->where('cookie_id', '=', $cookie_id);
        }

        $cart = $query->get();

        $total = $cart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);


        $message = Messages::all();
        return view('homepage.contact', [
            'message' => $message,
            'cart' => $cart,
            'total' => $formatter->formatCurrency($total, 'ILS'),

        ]);
    }

    public function create()
    {
        $cookie_id = request()->cookie('cart_id');
        $query = Cart::query();

        if ($cookie_id) {
            $query->where('user_id', '=', Auth::id())
                ->where('cookie_id', '=', $cookie_id);
        }

        $cart = $query->get();
        $total = $cart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);


        return view('homepage.contact', [
            'message' => new Messages(),
            'cart' => $cart,
            'total' => $formatter->formatCurrency($total, 'ILS'),

        ]);
    }

    public function store(MessageRequest $request)
    {

        $message = Messages::create($request->validated());

        return back()->with('success', "Has Been Added Successfully");
    }
}
