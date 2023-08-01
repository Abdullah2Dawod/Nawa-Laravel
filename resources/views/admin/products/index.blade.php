@extends('layouts.admin')
@section('sub_title' , 'Products')

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
    <hr>

    <div class="row">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <form action="{{ URL::current() }}" method="get" class="form-inline">
        <input type="text" name="search" class="form-control mb-2 mr-sm-2" value="{{ request('saerch') }}" placeholder="Search...">
        <select name="category_id" class="form-control mb-2 mr-sm-2">
            <option value="">All Categories</option>
            @foreach ($categories as $category )
            <option value="{{ $category->id }}" @selected(request('$category->id') == $category->id)>{{$category->name}}</option>
            @endforeach
        </select>
        <select name="status" class="form-control mb-2 mr-sm-2">
            <option value="">Status</option>
            @foreach ($status_options as $value => $kay )
            <option value="{{ $value }}" @selected(request('status') == $value)>{{$kay}}</option>
            @endforeach
        </select>
        <input type="number" name="price_min" class="form-control mb-2 mr-sm-2" value="{{ request('price_min') }}" placeholder="Min Price">
        <input type="number" name="price_max" class="form-control mb-2 mr-sm-2" value="{{ request('price_max') }}" placeholder="Max Price">
        <button type="submit" class="btn btn-success mb-2 mr-sm-2" style="border: none">Search</button>
    </form>
    <table class="table table-striped text-center mt-2">
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
                    <td>
                        <a href="{{ $product->image_url }}">
                            <img src="{{ $product->image_url }}" width="60" alt="">
                        </a>
                    </td>
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
