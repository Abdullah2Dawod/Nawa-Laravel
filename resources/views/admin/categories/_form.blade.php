{{--  @if ($errors->any())
    <div class="alert alert-danger">
        You have Errors :
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif  --}}

<div class="mb-3">
    <label for="name">Category Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        value="{{ old('name', $category->name) }}">
    @error('name')
        <p class="invalid-feedback"> {{ $message }}</p>
    @enderror
</div>

<button type="submit" class="btn btn-success">{{ $Submit ?? 'Save Category' }}</button>
