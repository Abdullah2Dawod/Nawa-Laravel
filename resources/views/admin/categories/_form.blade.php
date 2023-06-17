<div class="form-floating mb-3">
    <label for="name">Category Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
</div>

<button type="submit" class="btn btn-success">{{ $Submit ?? 'Save Category' }}</button>
