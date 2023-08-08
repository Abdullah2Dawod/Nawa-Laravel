@extends('layouts.admin')
@section('content')
@section('sub_title', 'Edit Users')

<form action="{{ route('users.update', $user->id) }}" method="post">
    @csrf
    @method('put')

    <div class="card card-info flex">
        <div class="card-header">
            <h3 class="card-title">Edit Users</h3>
        </div>
        <div class="row p-3">
            <div class="col align-self-center justify-content-around">
                <x-form.input label="First Name" id="name" name="name" value="{{ $user->name }}"
                    type="text" />
                <x-form.input label="Last Name" id="email" name="email" value="{{ $user->email }}"
                    type="text" />
            </div>

            <div class="border-right"></div>

            <div class="col align-self-center justify-content-around">

                <div class="form-floating mb-3">
                    <label for="status">User Status</label>
                    @foreach ($status_options as $value => $label)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status"
                                value="{{ $value }}" @checked($value == old('status', $user->status)) @endchecked>
                            <label class="form-check-label" for="{{ $value }}">
                                {{ $label }}
                            </label>
                        </div>
                    @endforeach
                </div>

            </div>

            <div class="border-right"></div>

            <div class="col align-self-center justify-content-around">

                <div class="form-floating mb-3">
                    <label for="type">User Types</label>
                    @foreach ($status_types as $value => $label)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="type"
                                value="{{ $value }}" @checked($value == old('type', $user->type)) @endchecked>
                            <label class="form-check-label" for="{{ $value }}">
                                {{ $label }}
                            </label>
                        </div>
                    @endforeach
                </div>

            </div>


        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Update Users</button>
        </div>
    </div>
</form>

@endsection
