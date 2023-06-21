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
        <x-form.input label="Product Name" id="name" name="name" value="{{ $product->name }}" type="text" />

        <x-form.input label="Url slug" id="slug" name="slug" value="{{ $product->slug }}" type="text" />


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

        <x-form.textarea label="Description" id="description" name="description" value="{{ $product->description }}" />

        <x-form.textarea label="short_description" id="short_description" name="short_description"
            value="{{ $product->short_description }}" />

    </div>

    <div class="col-md-4">

        <x-form.input label="Price" id="price" name="price" value="{{ $product->price }}" type="number" />

        <x-form.input label="Compare Price" id="compare_price" name="compare_price"
            value="{{ $product->compare_price }}" type="number" />


        <div class="mb-3">
            <label for="image">image</label>
            <div>
                <img src="{{ $product->image_url }}" width="60" alt="">
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <p class="invalid-feedback"> {{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="image">Product Gallery</label>
            <div class="div">
                <input type="file" class="form-control" id="gallery" name="gallery[]" multiple>
            </div>
            @if ($gallery ?? false)
                <div class="row">
                    @foreach ($gallery as $image)
                        <div class="col-md-3">
                            <img src="{{ $image->url }}" class="img-fluid">
                        </div>
                    @endforeach
                </div>

            @endif
        </div>


    </div>
</div>



<button type="submit" class="btn btn-success">{{ $Submit ?? 'Save Product' }}</button>
