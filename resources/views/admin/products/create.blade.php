@extends('layouts.admin')
@section('sub_title', 'Products / Create')

@section('content')
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.products._form', [
            'Submit' => 'Create Product',
        ])
    </form>
@endsection
