@extends('layouts.admin')
@section('sub_title' , 'Orders')

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
            <th>Phone</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Delete</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($messages as $message)
            <tr>
                <td>{{ $message->id }}</td>
                <td>{{ $message->name }} </td>
                <td>{{ $message->email }} </td>
                <td>{{ $message->phone }} </td>
                <td>{{ $message->subject }} </td>
                <td>{{ $message->message }} </td>
                <td>
                    <form action="{{ route('messages.destroy', $message->id) }}" method="post">
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

{{ $messages->links() }}

@endsection
