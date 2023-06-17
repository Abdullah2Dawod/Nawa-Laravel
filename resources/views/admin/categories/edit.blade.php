@extends('layouts.admin')
@section('content')
    <h2 class="mb-4 fs-3">New product</h2>

    <form action="{{ route('categories.update', $category->id) }}" method="post">
        @csrf
        @method('put')
        @include('admin.categories._form', [
            'Submit' => 'Update Category',
        ])
    </form>
@endsection
