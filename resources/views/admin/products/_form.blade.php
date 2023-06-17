<div class="form-floating mb-3">
    <label for="name">Product Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
</div>

<div class="form-floating mb-3">
    <label for="slug">URL Slug</label>
    <input type="text" class="form-control" id="slug" name="slug" value="{{ $product->slug }}">
</div>

<div class="form-floating mb-3">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id" class="form-control form-select">
        <option value=""></option>
        @foreach ($categories as $category)
            <option @selected($category->id == $product->category_id) value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-floating mb-3">
    <label for="description">Description</label>
    <input type="text" class="form-control" id="description" name="description" value="{{ $product->description }}">
</div>

<div class="form-floating mb-3">
    <label for="short_description">Short Description</label>
    <input type="text" class="form-control" id="short_description" name="short_description"
        value="{{ $product->short_description }}" placeholder="Description">
</div>

<div class="form-floating mb-3">
    <label for="price">Product Price</label>
    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
</div>

<div class="form-floating mb-3">
    <label for="compare_price">compare price</label>
    <input type="number" class="form-control" id="compare_price" name="compare_price"
        value="{{ $product->compare_price }}">
</div>

<div class="form-floating mb-3">
    <label for="image">image</label>
    <input type="file" class="form-control" id="image" name="image">
</div>
<button type="submit" class="btn btn-success">{{ $Submit ?? 'Save Product' }}</button>
