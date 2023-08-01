@extends('layouts.admin')
@section('sub_title' , 'Edit Categories')

@section('content')
    <h2 class="mb-4 fs-3">New product</h2>

    <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('admin.categories._form', [
            'Submit' => 'Update Category',
        ])
    </form>
@endsection
