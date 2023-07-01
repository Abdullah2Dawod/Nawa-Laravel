@extends('layouts.admin')
@section('content')
    <header class="mb-4 d-flex">
        <h2 class="mb-4 fs-3"> Trashed Category </h2>
        <div class="ml-auto">
            <a href="{{ route('categories.index') }}" type="button" class="btn btn-info p-2">Category List
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
                <th>Name</th>
                <th>Deleted At</th>
                <th>Restore</th>
                <th>Force Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->deleted_at }}</td>
                    <td>
                        <form action="{{ route('categories.restore', $category->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-trash-restore"></i></button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('categories.force-delete', $category->id) }}" method="post">
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

    {{ $categories->links() }}
@endsection
