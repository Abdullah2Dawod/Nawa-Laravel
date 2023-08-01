@extends('layouts.shop')
@section('title', 'About Us')

@section('content')

    <!-- Start Contact Area -->
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>Contact Us</h2>
                            <p>There are many variations of passages of Lorem
                                Ipsum available, but the majority have suffered alteration in some form.</p>
                        </div>
                    </div>
                </div>
                <div class="contact-info">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-12">
                            <div class="single-info-head">
                                <!-- Start Single Info -->
                                <div class="single-info">
                                    <i class="lni lni-map"></i>
                                    <h3>Address</h3>
                                    <ul>
                                        <li>44 Shirley Ave. West Chicago,<br> IL 60185, USA.</li>
                                    </ul>
                                </div>
                                <!-- End Single Info -->
                                <!-- Start Single Info -->
                                <div class="single-info">
                                    <i class="lni lni-phone"></i>
                                    <h3>Call us on</h3>
                                    <ul>
                                        <li><a href="tel:+18005554400">+1 800 555 44 00 (Toll free)</a></li>
                                        <li><a href="tel:+321556667890">+321 55 666 7890</a></li>
                                    </ul>
                                </div>
                                <!-- End Single Info -->
                                <!-- Start Single Info -->
                                <div class="single-info">
                                    <i class="lni lni-envelope"></i>
                                    <h3>Mail at</h3>
                                    <ul>
                                        <li><a href="mailto:support@shopgrids.com">support@shopgrids.com</a>
                                        </li>
                                        <li><a href="mailto:career@shopgrids.com">career@shopgrids.com</a></li>
                                    </ul>
                                </div>
                                <!-- End Single Info -->
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-12">
                            <div class="contact-form-head">
                                <div class="form-main">
                                    <div class="row">
                                        @if (session()->has('success'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                    </div>
                                    <form class="form" method="post" action="{{ route('store_contact_us') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="name" class="@error('name') is-invalid @enderror" type="text" placeholder="Your Name"
                                                        value="{{ old('name', $message->name) }}">
                                                    @error('name')
                                                        <p class="invalid-feedback"> {{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="subject" class="@error('subject') is-invalid @enderror" type="text" placeholder="Your Subject"
                                                        value="{{ old('subject', $message->subject) }}">
                                                        @error('subject')
                                                        <p class="invalid-feedback"> {{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="email" class="@error('email') is-invalid @enderror" type="email" placeholder="Your Email"
                                                        value="{{ old('email', $message->email) }}">
                                                        @error('email')
                                                        <p class="invalid-feedback"> {{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="phone" class="@error('phone') is-invalid @enderror" type="text" placeholder="Your Phone"
                                                        value="{{ old('phone', $message->phone) }}">
                                                        @error('phone')
                                                        <p class="invalid-feedback"> {{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group message">
                                                    <textarea name="message" placeholder="Your Message" value="{{ $message->message }}">{{ old('message', $message->message) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button">
                                                    <button type="submit" class="btn ">Submit Message</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact Area -->


@endsection
