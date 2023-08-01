@extends('layouts.admin')
@section('content')
@section('sub_title', 'Edit Orders')

<form action="{{ route('orders.update', $order->id) }}" method="post">
    @csrf
    @method('put')

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
            <h3 class="card-title">Edit User Orders</h3>
        </div>
        <div class="row p-3">
            <div class="col-md-3">
                <x-form.input label="First Name" id="customer_first_name" name="customer_first_name"
                    value="{{ $order->customer_first_name }}" type="text" />
                <x-form.input label="Last Name" id="customer_last_name" name="customer_last_name"
                    value="{{ $order->customer_last_name }}" type="text" />
                <x-form.input label="Email" id="customer_email" name="customer_email"
                    value="{{ $order->customer_email }}" type="text" />
            </div>

            <div class="border-right"></div>

            <div class="col-md-3">
                <x-form.input label="Phone" id="customer_phone" name="customer_phone"
                    value="{{ $order->customer_phone }}" type="number" />
                <x-form.input label="Address" id="customer_address" name="customer_address"
                    value="{{ $order->customer_address }}" type="text" />
                <x-form.input label="First Name" id="customer_city" name="customer_city"
                    value="{{ $order->customer_city }}" type="text" />
            </div>

            <div class="border-right"></div>

            <div class="col-md-3">
                <x-form.input label="Postal Code" id="customer_postal_code" name="customer_postal_code"
                    value="{{ $order->customer_postal_code }}" type="text" />
                <x-form.input label="Province" id="customer_province" name="customer_province"
                    value="{{ $order->customer_province }}" type="text" />
                <x-form.input label="Country Code" id="customer_country_code" name="customer_country_code"
                    value="{{ $order->customer_country_code }}" type="text" />
            </div>

            <div class="border-right"></div>

            <div class="col-md-2">
                <x-form.input label="Total" id="total" name="total" value="{{ $order->total }}"
                    type="number" />
                    <div class="form-floating mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control form-select">
                            <option value="">Status</option>
                            @foreach ($status_options as $value => $label)
                                <option @selected($value == old('value', $order->value)) value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                        <label for="status">Status Payment</label>
                        <select name="status" id="status" class="form-control form-select">
                            <option value="">Status Payment</option>
                            @foreach ($status_payment as $value => $label)
                                <option @selected($value == old('value', $order->value)) value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>




        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Update Orders</button>
        </div>
    </div>



</form>

@endsection
