@extends('layouts.admin')
@section('sub_title', 'Categories / Create')

@section('content')

    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.categories._form', [
            'Submit' => 'Create Category',
        ])
    </form>
@endsection
