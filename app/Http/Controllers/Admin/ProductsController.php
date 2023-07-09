<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Expr\Cast\String_;

class ProductsController extends Controller
{

    public function __construct()
    {
        $categories = Category::all();
        View::share([
            "categories" => $categories,
            'status_options' => Product::statusOptions(),
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // $products = DB::table('products')
        // ->leftJoin('categories' , 'categories.id' , '=' , 'products.category_id')
        // ->select([
        //     'products.*',
        //     'categories.name as category_name'
        // ])
        // ->get();

        $products = Product::leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->select([
                'products.*',
                'categories.name as category_name'
            ])
            // ->withoutGlobalScope('owner') // وتعني ايقاف قلوبل سكوب بأسم اونر
            // ->withoutGlobalScopes() // وتعني ايقاف جميع القلوبل سكوب في الموديل
            // ->active()
            // ->status('draft')
            ->filter($request)
            ->paginate(10);

        return view('admin.products.index', [
            'title' => 'Products List',
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = Category::all();
        return view('admin.products.create', [
            'product' => new Product(),
            // 'categories' => $categories,
            // 'status_options' => Product::statusOptions(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // $rules = [
        //     'name' => 'required|max:255|min:3',
        //     'slug' => 'required|unique:products,slug',
        //     'category_id' => 'nullable|int|exists:categories,id',
        //     'description' => 'nullable|string',
        //     'description_short' => 'nullable|string|max:500',
        //     'price' => 'required|numeric|min:0',
        //     'compare_price' => 'nullable|numeric|min:0|gt:price',
        //     'image' => 'nullable|image|dimensions:min_width=400,min_height=300|max:500',
        //     'status' => 'required|in:active,draft,archived',

        // ];

        // $messages = [
        //     'required' => ':attribute field is required', // كل حقل معمولو ريكورد بياخد الرسالة هادي مع اسم الحقل عشان ضفنا اتربيوت
        //     'unique' => 'the value in exists', // كل حقل ماخد يونيك بتطلعلوا الرسالة هادي
        //     'name.required' => 'the product هذا خطأ', //  الحقل الي اسمو نيم وماخد ريكورد , بتطلعلوا الرسالة هادي
        // ];
        // $rules = $this->rules();
        // $messages = $this->messages();
        // $request->validate($rules, $messages);

        // $product = Product::create( $request->all() ); //هذه الحركة تغني عن جميع الكود تاع الاستدعاء للحقول في الأسفل , إختصار لجملة الاستدعاء في الاسفل
        // $product = Product::create( $request->only( 'name' , 'slug') ); // وهنا تعني استدعي فقط الحقلين النيم والسلق
        // $product = Product::create( $request->except( 'name' , 'slug') ); //وهنا تعني استدعي جميع الحقول ما عدا الحقلين النيم والسلق

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
        // $product = new Product();
        // $product->name = $request->input('name');
        // $product->slug = $request->input('slug');
        // $product->category_id = $request->input('category_id');
        // $product->description = $request->input('description');
        // $product->short_description = $request->input('short_description');
        // $product->price = $request->input('price');
        // $product->status = $request->input('status', 'active');
        // $product->compare_price = $request->input('compare_price');
        // $product->save();

        return redirect()
            ->route('products.index')
            ->with('success', "Product $product->name Has Been Added Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // $product = Product::findOrFail($id);
        // $categories = Category::all();
        $gallery = ProductImage::Where('product_id', '=', $product->id)->get();

        return view('admin.products.edit', [
            'product' => $product,
            // 'categories' => $categories,
            // 'status_options' => Product::statusOptions(),
            'gallery' => $gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        // $rules = [
        //     'name' => 'required|max:255|min:3',
        //     'slug' => "required|unique:products,slug,$id",
        //     'category_id' => 'nullable|int|exists:categories,id',
        //     'description' => 'nullable|string',
        //     'description_short' => 'nullable|string|max:500',
        //     'price' => 'required|numeric|min:0',
        //     'compare_price' => 'required|numeric|min:0|gt:price',
        //     'image' => 'nullable|image|dimensions:min_width=400,min_height=300|max:500',
        //     'status' => 'required|in:active,draft,archived',
        // ];
        // $rules = $this->rules($id);
        // $messages = $this->messages();
        // $request->validate($rules, $messages);

        // $product = Product::findOrFail($id);

        $date = $request->validated();
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


        // $product->name = $request->input('name');
        // $product->slug = $request->input('slug');
        // $product->category_id = $request->input('category_id');
        // $product->description = $request->input('description');
        // $product->short_description = $request->input('short_description');
        // $product->price = $request->input('price');
        // $product->status = $request->input('status', 'active');
        // $product->compare_price = $request->input('compare_price');
        // $product->save();

        return redirect()
            ->route('products.index')
            ->with('success', "Product $product->name Has Been Updated Successfully");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        // $product = Product::findOrFail($id);

        $product->delete();

        // Product::destroy($id);

        return redirect()
            ->route('products.index')
            ->with('success', "Product $product->name Has Been Deleted Successfully");
    }

    public function messages()
    {
        return [
            'required' => ':attribute field is required', // كل حقل معمولو ريكورد بياخد الرسالة هادي مع اسم الحقل عشان ضفنا اتربيوت
            'unique' => 'the value in exists', // كل حقل ماخد يونيك بتطلعلوا الرسالة هادي
            'name.required' => 'the product هذا خطأ', //  الحقل الي اسمو نيم وماخد ريكورد , بتطلعلوا الرسالة هادي
        ];
    }

    public function rules($id = 0)
    {
        return [
            'name' => 'required|max:255|min:3',
            'slug' => "required|unique:products,slug,$id",
            'category_id' => 'nullable|int|exists:categories,id',
            'description' => 'nullable|string',
            'description_short' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'required|numeric|min:0|gt:price',
            'image' => 'nullable|image|dimensions:min_width=400,min_height=300|max:500',
            'status' => 'required|in:active,draft,archived',
        ];
    }

    // خاص بصفحة عرض المنتجات المحذوفة لل products
    public function trashed()
    {
        $products = Product::onlyTrashed()->paginate(12);
        return view('admin.products.trashed', [
            'products' => $products
        ]);
    }

    public function restore(String $id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()
            ->route('products.index')
            ->with('success', "Product ({$product->name}) restored");
    }

    public function forceDelete(String $id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        return redirect()
            ->route('products.trashed')
            ->with('success', "Product ({$product->name}) Deleted Forever");
    }
}
