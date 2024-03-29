<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::withAvg('products', 'price')
            ->withCount('products')->filter($request)->paginate(15);

        return view('admin.categories.index', [
            'title' => 'categories List',
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create', [
            'category' => new Category(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        // $category = Category::create($request->validated());

        // $categories = new Category();
        // $categories->name = $request->input('name');
        // $categories->save();

        $date = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/images', 'public');
            $date['image'] = $path;
        }

        $category = Category::create($date);

        return redirect()->route('categories.index')
            ->with('success', "category $category->name Has Been Added Successfully");
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
    public function edit(Category $category)
    {
        // $category = Category::findOrFail($id);
        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {

        // $category->update($request->validated());

        $date = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/images', 'public');
            $date['image'] = $path;
        }

        $old_image = $category->image;
        $category->update($date);

        if ($old_image && $old_image != $category->image) {
            Storage::disk('public')->delete($old_image);
        }

        // $category = Category::findOrFail($id);

        // $category->name = $request->input('name');

        // $category->save();

        return redirect()
            ->route('categories.index')
            ->with('success', "Product $category->name Has Been Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // $category = Category::findOrFail($id);
        $category->delete();

        // Product::destroy($id);

        return redirect()
            ->route('categories.index')
            ->with('success', "Category $category->name Has Been Deleted Successfully");
    }

    public function trashed()
    {
        $categories = Category::onlyTrashed()->paginate(12);
        return view('admin.categories.trashed', [
            'categories' => $categories
        ]);
    }

    public function restore(String $id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->restore();
        return redirect()
            ->route('categories.index')
            ->with('success', "Category ({$categories->name}) restored");
    }

    public function forceDelete(String $id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->forceDelete();
        if ($categories->image) {
            Storage::disk('public')->delete($categories->image);
        }

        return redirect()
            ->route('categories.trashed')
            ->with('success', "Category ({$categories->name}) Deleted Forever");
    }
}
