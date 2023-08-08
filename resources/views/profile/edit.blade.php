@extends('layouts.shop')
@section('title', '')

@section('content')

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





    <form class="form" method="post" action="{{ route('profile.update', $user->id) }}">
        @csrf
        @method('patch')
        <div class="container mt-5 mb-5">
            <div class="card border-primary text-bg-primary mb-3">
                <div class="card-header">Header</div>

                <div class="row p-3">

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="first_name">First Name</label>
                            <input name="first_name" class="form-control" type="text" placeholder="first Name"
                                value="{{ old('first_name', $user->profile->first_name) }}" required="required">
                        </div>
                        <div class="mb-3">
                            <label for="last_name">Last Name</label>
                            <input name="last_name" class="form-control" type="text" placeholder="last name"
                                value="{{ old('first_name', $user->profile->last_name) }}" required="required">
                        </div>

                        <div class="mb-3">
                            <label for="gender">Gender</label>
                            @foreach ($gender_options as $value => $label)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id=""
                                        value="{{ $value }}" @checked($value == old('gender', $user->profile->gender)) @endchecked>
                                    <label class="form-check-label" for="{{ $value }}">
                                        {{ $label }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input name="email" class="form-control" type="email" placeholder="Your Email"
                                value="{{ old('email', $user->email) }}" required="required">
                        </div>

                        <div class="mb-3">
                            <label for="birthday">Birthday</label>
                            <input name="birthday" class="form-control" type="date" placeholder="birthday"
                                value="{{ old('birthday', $user->profile->birthday) }}" required="required">
                        </div>
                        <div class="mb-3">
                            <label for="street">Street</label>
                            <input name="street" class="form-control" type="text" placeholder="street"
                                value="{{ old('street', $user->profile->street) }}" required="required">
                        </div>

                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="city">City</label>
                            <input name="city" class="form-control" type="text" placeholder="Your City"
                                value="{{ old('city', $user->profile->city) }}" required="required">
                        </div>

                        <div class="mb-3">
                            <label for="province">Province</label>
                            <input name="province" class="form-control" type="text" placeholder="province"
                                value="{{ old('province', $user->profile->province) }}" required="required">
                        </div>

                        <div class="mb-3">
                            <label for="postal_code">Postal Code</label>
                            <input name="postal_code" class="form-control" type="text" placeholder="postal code"
                                value="{{ old('postal_code', $user->profile->postal_code) }}" required="required">
                        </div>

                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="country_code">Country Code</label>
                            <input name="country_code" class="form-control" type="text" placeholder="country code"
                                value="{{ old('country_code', $user->profile->country_code) }}" required="required">
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
    </form>
@endsection
