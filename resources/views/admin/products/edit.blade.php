@extends('layouts.admin')
@section('sub_title' , 'Edit Products')

@section('content')
    <h2 class="mb-4 fs-3">New product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('admin.products._form', [
            'Submit' => 'Update Product',
        ])
    </form>
@endsection
