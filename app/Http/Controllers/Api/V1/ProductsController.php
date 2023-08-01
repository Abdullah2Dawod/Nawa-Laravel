<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Product::with(['user', 'category', 'gallery'])
                    ->filter($request->query())
                    ->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        $date = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/images', 'public');
            $date['image'] = $path;
        }
        $date['user_id'] = Auth::id();

        $product = Product::create($date); //وهنا تعني استدعاء كل الحقول ال1ي تم التحقق منها وعمل عليها فلديشن

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as  $file) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->store('uploads/images', 'public'),
                ]);
            }
        }

        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Product::with('category', 'user', 'gallery')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $date = $request->validate([
            'name' => ['sometimes', 'required'],
            'category_id' => ['sometimes', 'required'],
            'price' => ['sometimes', 'required', 'numeric']
        ]);

        // $date = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/images', 'public');
            $date['image'] = $path;
        }

        $old_image = $product->image;
        $product->update($date);

        if ($old_image && $old_image != $product->image) {
            Storage::disk('public')->delete($old_image);
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as  $file) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->store('uploads/images', 'public'),
                ]);
            }
        }

        return [
            'message' =>'success updated product!',
            'product'    => $product,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return [
            'message' => 'The Product Deleted'
        ];
    }
}
