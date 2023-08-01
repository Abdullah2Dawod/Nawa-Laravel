@extends('layouts.admin')
@section('sub_title' , 'Categories')

@section('content')
    <header class="mb-4 d-flex">
        <h2 class="mb-4 fs-3">{{ $title }} </h2>
        <div class="ml-auto">
            <a href="{{ route('categories.create') }}" type="button" class="btn btn-info p-2">Create Category
                <i class="fas fa-plus"></i></a>
            <a href="{{ route('categories.trashed') }}" type="button" class="btn btn-danger p-2">Categories Trashed
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

    <form action="{{ URL::current() }}" method="get" class="form-inline">
        <input type="text" name="search" class="form-control mb-2 mr-sm-2" value="{{ request('saerch') }}" placeholder="Search Category...">
        <button type="submit" class="btn btn-success mb-2 mr-sm-2" style="border: none">Search</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr class="table-dark">
                <th>Id</th>
                <th>Name</th>
                <th>Image</th>
                <th>product Count</th>
                <th>product AVG Price</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }} </td>
                    <td>
                        <a href="{{ $category->image_url }}">
                            <img src="{{ $category->image_url }}" width="70" alt="">
                        </a>
                    </td>
                    <td>{{ $category->products_count }} </td>
                    <td>{{ $category->products_avg_price }} </td>
                    <td><a href="{{ route('categories.edit', $category->id) }}" class="btn-sm btn btn-outline-secondary">
                            <i class="far fa-edit"></i< /a>
                    </td>
                    <td>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
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

    {{ $categories->links() }}
@endsection
