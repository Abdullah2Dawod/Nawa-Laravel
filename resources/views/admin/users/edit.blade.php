@extends('layouts.admin')
@section('content')
@section('sub_title', 'Edit Users')

<form action="{{ route('users.update', $user->id) }}" method="post">
    @csrf
    @method('put')

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Edit Users</h3>
        </div>
        <div class="row p-3">
            <div class="col-md-4">
                <x-form.input label="First Name" id="name" name="name"
                    value="{{ $user->name }}" type="text" />
                <x-form.input label="Last Name" id="email" name="email"
                    value="{{ $user->email }}" type="text" />
            </div>

            <div class="border-right"></div>

            <div class="col-md-4">

                <div class="form-floating mb-3">
                    <label for="status">User Status</label>
                    <select name="status" id="status" class="form-control form-select">
                        <option value="">Type</option>
                        @foreach ($status_options as $value => $label)
                            <option @selected($value == old('value', $user->value)) value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <label for="type">User Type</label>
                    <select name="type" id="type" class="form-control form-select">
                        <option value="">Type</option>
                        @foreach ($status_types as $value => $label)
                            <option @selected($value == old('value', $user->value)) value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

            </div>


        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Update Users</button>
        </div>
    </div>



</form>

@endsection
