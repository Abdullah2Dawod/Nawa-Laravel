<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function category($id)
    {
        $products = Product::with('category')->where('category_id' , 'id')->paginate();
        $category = Category::findOrFail($id);

        return view('homepage.shopping.index' , compact('category' , 'products'));

    }
}
