@extends('layouts.admin')
@section('content')
    <header class="mb-4 d-flex">
        <h2 class="mb-4 fs-3">{{ $title }} </h2>
        <div class="ml-auto">
            <a href="{{ route('products.create') }}" type="button" class="btn btn-info p-2">Create Proudct
                <i class="fas fa-plus"></i></a>
            <a href="{{ route('products.trashed') }}" type="button" class="btn btn-danger p-2">Products Trashed
                <i class="fas fa-trash-alt"></i></a>
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
                <th>Images</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
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
                    {{--  <td>
                        <a href="{{$product->image_link}}">
                            <img src="{{$product->image_link}}" width="60" alt="">
                        </a>
                    </td>  --}}
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category_name }}</td>
                    <td>{{ $product->price_formatted }}</td>
                    <td>{{ $product->status }}</td>
                    <td><a href="{{ route('products.edit', $product->id) }}" class="btn-sm btn btn-outline-secondary"><i
                                class="far fa-edit"></i< /a>
                    </td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i
                                    class="fas fa-trash"></i></button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
@endsection
