<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Messages;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use NumberFormatter;

class HomeController extends Controller
{

    public function index(Request $request)
    {

        $cookie_id = $request->cookie('cart_id');
        $cart = Cart::with('product')->where('cookie_id', '=', $cookie_id)->get();

        $total = $cart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });


        $cart = Cart::all();

        $price_large_products = Product::where('price', '>=', 1000)->get();


        $mobiles = 'Mobiles';
        $mixers = 'Mixers';
        // $mobiles = 'Mobiles';
        // $mobiles = 'Mobiles';
        // $mobiles = 'Mobiles';
        // $mobiles = 'Mobiles';

        $products_mobiles = Product::with('category')->byCategoryType($mobiles)->get();


        $products = Product::withoutGlobalScope('owner')
            ->with('category')  //Eager loud
            // ->active()
            ->latest('updated_at')
            ->get();

        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);

        return view('homepage.home', [
            'products' => $products,
            'cart' => $cart,
            'products_mobiles' => $products_mobiles,
            'price_large_products' => $price_large_products,
        ]);
    }

    public function product($id)
    {
        // $product = Product::findOrFail($id);
        // // $products = Product::with('category')->get();
        // $products = Product::with('category')->where('category_id', 'id')->get();
        // return view('site.prdouctDetailes', compact('product', 'products'));

        $products = Category::findOrFail($categoryId)->products;

        $products = Product::where('category_id', $categoryId)->get();

        $products = Product::whereHas('category', function ($query) use ($categoryId) {
            $q->where('id', $categoryId);
        })->get();
    }

    public function about()
    {
        return view('homepage.about', []);
    }

    public function index_contact()
    {
        $message = Messages::all();
        return view('homepage.contact', [
            'message' => $message,
        ]);
    }

    public function create()
    {
        return view('homepage.contact', [
            'message' => new Messages(),
        ]);
    }

    public function store(MessageRequest $request)
    {

        $message = Messages::create($request->validated());

        return back()->with('success', "Has Been Added Successfully");
    }
}
