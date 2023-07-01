<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::withoutGlobalScope('owner')
            ->status('active')
            ->latest('updated_at')
            ->take(8)
            ->get();

        return view('homepage.home', [
            'products' => $products,
        ]);
    }
}
