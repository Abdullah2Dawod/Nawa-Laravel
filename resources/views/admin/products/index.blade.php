@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-6">
            <h2 class="mb-4 fs-3">{{ $title }} </h2>
        </div>
        <div class="col-6 d-flex align-items-end flex-column">
            <a href="{{ route('products.create') }}" type="button" class="btn btn-info p-2">Create Proudct</a>
        </div>
    </div>
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
                    {{--  <th>
                        @if($product->image)
                        <a href="{{asset('storage/' . $product->image)}}">
                            <img src="{{Storage::disk('public')->url($product->image)}}" width="60" alt="">
                        </a>
                        @else
                        <img src="https://placehold.co/60x60?text=No+Image" alt="">
                        @endif
                    </th>  --}}
                    <td>
                        <a href="{{$product->image_link}}">
                            <img src="{{$product->image_link}}" width="60" alt="">
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
@endsection
