@extends('layouts.admin')
@section('content')
@section('sub_title', 'Users Profile')

<form action="{{ route('users.show', $user->id) }}" method="get">

    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 155px;">
                            <h5 class="my-3">{{ $user->name }}</h5>
                            <p class="text-muted mb-3">{{ $user->profile->gender }} - {{ $user->profile->birthday }}
                            </p>
                            <p class="text-muted mb-4">{{ $user->profile->country_code }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">User Type</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->type }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Status</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->status }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->profile->city }} -
                                        {{ $user->profile->street }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Postal Code</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->profile->province }} -
                                        {{ $user->profile->postal_code }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <a href="{{ route('users.edit' , $user->id)}}" type="button" class="btn btn-danger">Edit Profile</a>
                </div>
            </div>
        </div>
    </section>

</form>

@endsection
