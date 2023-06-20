@if ($errors->any())
    <div class="alert alert-danger">
        You have Errors :
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label for="name">Product Name</label>
            <div>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $product->name) }}">
                @error('name')
                    <p class="invalid-feedback"> {{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="slug">URL Slug</label>
            <div>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                    name="slug" value="{{ old('slug', $product->slug) }}">
                @error('slug')
                    <p class="invalid-feedback"> {{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-floating mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control form-select">
                <option value=""></option>
                @foreach ($categories as $category)
                    <option @selected($category->id == old('category_id', $product->category_id)) value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4">

        <div class="mb-3">
            <label for="status">Status</label>
            <div>
                @foreach ($status_options as $value => $label)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_{{ $value }}"
                            value="{{ $value }}" @checked($value == old('status', $product->status))>
                        <label class="form-check-label" for="status_{{ $value }}">
                            {{ $label }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label for="description">Description</label>
            <div>
                <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" value="{{ old('description', $product->description) }}" rows="2"></textarea>
                @error('description')
                    <p class="invalid-feedback"> {{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-floating mb-3">
            <label for="short_description">Short Description</label>
            <div>
                <input type="text" class="form-control @error('short_description') is-invalid @enderror"
                    id="short_description" name="short_description"
                    value="{{ old('short_description', $product->short_description) }}" placeholder="Description">
                @error('short_description')
                    <p class="invalid-feedback"> {{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-4">

        <div class="form-floating mb-3">
            <label for="price">Product Price</label>
            <div>
                <input type="number" step="0.1" min="0"
                    class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                    value="{{ old('price', $product->price) }}">
                @error('price')
                    <p class="invalid-feedback"> {{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-floating mb-3">
            <label for="compare_price">compare price</label>
            <div>
                <input type="number" step="0.1" min="0"
                    class="form-control @error('compare_price') is-invalid @enderror" id="compare_price"
                    name="compare_price" value="{{ old('compare_price', $product->compare_price) }}">
                @error('compare_price')
                    <p class="invalid-feedback"> {{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-floating mb-3">
            <label for="image">image</label>
            <div>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image">
                @error('image')
                    <p class="invalid-feedback"> {{ $message }}</p>
                @enderror
            </div>
        </div>

    </div>
</div>



<button type="submit" class="btn btn-success">{{ $Submit ?? 'Save Product' }}</button>
