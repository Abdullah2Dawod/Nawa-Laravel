@extends('layouts.admin')
@section('sub_title' , 'Trashed Orders')

@section('content')
    <header class="mb-4 d-flex">
        <h2 class="mb-4 fs-3"> Trashed Category </h2>
        <div class="ml-auto">
            <a href="{{ route('orders.index') }}" type="button" class="btn btn-info p-2">Orders List
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
    <table class="table table-striped text-center mt-2" style="font-size: 15px !important">
        <thead>
            <tr class="table-dark">
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Province</th>
                <th>Country Code</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Currency</th>
                <th>Total</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_first_name }}</td>
                    <td>{{ $order->customer_last_name }}</td>
                    <td>{{ $order->customer_email }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>{{ $order->customer_address }}</td>
                    <td>{{ $order->customer_city }}</td>
                    <td>{{ $order->customer_postal_code }}</td>
                    <td>{{ $order->customer_province }}</td>
                    <td>{{ $order->customer_country_code }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->currency }}</td>
                    <td>{{ $order->total }}</td>


                    <td>
                        <form action="{{ route('orders.restore', $order->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-trash-restore"></i></button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('orders.force-delete', $order->id) }}" method="post">
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


    {{ $orders->links() }}
@endsection
