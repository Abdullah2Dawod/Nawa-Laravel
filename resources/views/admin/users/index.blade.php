@extends('layouts.admin')
@section('sub_title' , 'Users')

@section('content')

<header class="mb-4 d-flex">
    <h2 class="mb-4 fs-3">{{ $title }} </h2>
</header>

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
            <th>Email</th>
            <th>Type</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }} </td>
                <td>{{ $user->email }} </td>
                <td>{{ $user->type }} </td>
                <td>{{ $user->status }} </td>

                <td><a href="{{ route('users.edit', $user->id) }}" class="btn-sm btn btn-outline-secondary">
                        <i class="far fa-edit"></i< /a>
                </td>
                <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
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

{{ $users->links() }}

@endsection
