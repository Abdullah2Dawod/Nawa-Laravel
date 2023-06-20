<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
            ->get();

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
        $categories = Category::all();
        return view('admin.products.create', [
            'product' => new Product(),
            'categories' => $categories,
            'status_options' => Product::statusOptions(),
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
            $path = $file->store('uploads/images' , 'public');
            $date['image'] = $path;
        }
        $product = Product::create( $date ); //وهنا تعني استدعاء كل الحقول ال1ي تم التحقق منها وعمل عليها فلديشن


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
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'status_options' => Product::statusOptions(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
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

        $product = Product::findOrFail($id);

        $date = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/images' , 'public');
            $date['image'] = $path;
        }

            $old_image = $product->image;
        $product ->update( $date );

        if ($old_image && $old_image != $product->image) {
            Storage::disk('public')->delete($old_image);
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
            ->with('success', "Product $product->name Has Been Updated Successfully");;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $product = Product::findOrFail($id);

        $product->delete();

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }


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
}
