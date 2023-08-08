@extends('layouts.admin')
@section('content')
@section('sub_title', 'Create Users')

<form action="{{ route('users.store') }}" method="post">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            You have Errors :
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add New Users</h3>
        </div>

        <div class="mb-3 p-4">
            <label for="name">User Name</label>
            <input type="text" class="form-control col-md-4 @error('name') is-invalid @enderror" id="name"
                name="name" value="{{ old('name', $user->name) }}">
            @error('name')
                <p class="invalid-feedback"> {{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3 p-4">
            <label for="name">email</label>
            <input type="text" class="form-control col-md-4 @error('name') is-invalid @enderror" id="email"
                name="email" value="{{ old('email', $user->email) }}">
            @error('name')
                <p class="invalid-feedback"> {{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3 p-4">
            <label for="name">password</label>
            <input type="text" class="form-control col-md-4 @error('name') is-invalid @enderror" id="password"
                name="password" value="{{ old('password', $user->password) }}">
            @error('name')
                <p class="invalid-feedback"> {{ $message }}</p>
            @enderror
        </div>
        {{--  <div class="mb-3 p-4">
            <label for="name">Type User</label>
            <input type="text" class="form-control col-md-4 @error('name') is-invalid @enderror" id="type"
                name="type" value="{{ old('email', $user->type) }}">
            @error('name')
                <p class="invalid-feedback"> {{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3 p-4">
            <label for="name">Status</label>
            <input type="text" class="form-control col-md-4 @error('name') is-invalid @enderror" id="stutas"
                name="stutas" value="{{ old('email', $user->stutas) }}">
            @error('name')
                <p class="invalid-feedback"> {{ $message }}</p>
            @enderror
        </div>  --}}

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Add User</button>
        </div>

    </div>

</form>


@endsection
