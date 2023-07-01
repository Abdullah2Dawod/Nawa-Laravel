@extends('layouts.admin')
@section('content')
    <header class="mb-4 d-flex">
        <h2 class="mb-4 fs-3"> Trashed Products </h2>
        <div class="ml-auto">
            <a href="{{ route('products.index') }}" type="button" class="btn btn-info p-2">product List
                <i class="fas fa-plus"></i></a>
        </div>
    </header>

    <div class="row">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <table class="table table-striped text-center">
        <thead>
            <tr class="table-dark">
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th>Deleted At</th>
                <th>Restore</th>
                <th>Force Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <th>
                        <a href="{{ $product->image_url }}">
                            <img src="{{ $product->image_url }}" width="60" alt="">
                        </a>
                    </th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->deleted_at }}</td>
                    <td>
                        <form action="{{ route('products.restore', $product->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-trash-restore"></i></button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('products.force-delete', $product->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
@endsection
