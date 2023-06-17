@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-6">
            <h2 class="mb-4 fs-3"><?= $title ?></h2>
        </div>
        <div class="col-6 grid d-flex align-items-end flex-column">
            <a href="{{ route('categories.create') }}" type="button" class="btn btn-info p-2">Create category</a>
        </div>
    </div>
    <div class="row">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <table class="table table-striped">
        <thead>
            <tr class="table-dark">
                <th>Id</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }} </td>
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
@endsection
