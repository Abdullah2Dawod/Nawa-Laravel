@extends('layouts.admin')
@section('sub_title' , 'Orders')

@section('content')
    <header class="mb-4 d-flex">
        <h2 class="mb-4 fs-3">{{ $title }} </h2>
        <div class="ml-auto">
            <a href="{{ route('orders.trashed') }}" type="button" class="btn btn-danger p-2">Orders Trashed
                <i class="fas fa-trash-alt"></i></a>
        </div>
    </header>
    <hr>

    <div class="row">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <form action="{{ URL::current() }}" method="get" class="form-inline">
        <input type="text" name="search" class="form-control mb-2 mr-sm-2" value="{{ request('saerch') }}" placeholder="Search...">

        <select name="status" class="form-control mb-2 mr-sm-2">
            <option value="">Status</option>
            @foreach ($status_options as $value => $kay )
            <option value="{{ $value }}" @selected(request('status') == $value)>{{$kay}}</option>
            @endforeach
        </select>

        <select name="payment_status" class="form-control mb-2 mr-sm-2">
            <option value="">payment_status</option>
            @foreach ($payment_status as $value => $kay )
            <option value="{{ $value }}" @selected(request('payment_status') == $value)>{{$kay}}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-success mb-2 mr-sm-2" style="border: none">Search</button>
    </form>
    <table class="table table-striped text-center mt-2" style="font-size: 15px !important">
        <thead>
            <tr class="table-dark">
                <th>Id</th>
                <th>F Name</th>
                <th>L Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>City</th>
                <th>Pl Code</th>
                <th>Province</th>
                <th>Cy Code</th>
                <th>Status</th>
                <th>Pay Status</th>
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
                    <td>{{ $order->total }}</td>


                    <td><a href="{{ route('orders.edit', $order->id) }}" class="btn-sm btn btn-outline-secondary"><i
                                class="far fa-edit"></i< /a>
                    </td>
                    <td>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="post">
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

    {{ $orders->links() }}
@endsection
