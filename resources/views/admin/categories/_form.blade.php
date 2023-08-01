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

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Add New Categories</h3>
    </div>


    <div class="mb-3 p-4">
        <label for="name">Category Name</label>
        <input type="text" class="form-control col-md-4 @error('name') is-invalid @enderror" id="name"
            name="name" value="{{ old('name', $category->name) }}">
        @error('name')
            <p class="invalid-feedback"> {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3  p-4">
        <label for="image">image</label>
        <div>
            <img src="{{ $category->image_url }}" width="60" alt="" class=" mb-2">
            <input type="file" class="form-control" id="image" name="image">
            @error('image')
                <p class="invalid-feedback"> {{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success">{{ $Submit ?? 'Save Category' }}</button>
    </div>

</div>
