@extends('layouts.shop')
@section('title', 'Home')

@section('content')

    @php
        $breadcrumb = 'Home => Products'; // Set the breadcrumb value
    @endphp

    <!-- Start Hero Area -->
    <section class="hero-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 custom-padding-right">
                    <div class="slider-head">
                        <!-- Start Hero Slider -->
                        <div class="hero-slider">
                            <div class="single-slider"
                                style="background-image: url('{{ asset('assets/images/backgrund.jpg') }}')">
                                <div class="content"">
                                    <h5>Welcome to Shop Gride store ..</h5>
                                    <p>The store contains many items</p>
                                    <h3><span>Live your experience from here</h3>
                                    <div class="button">
                                        <a href="" class="btn">Shopping Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Hero Slider -->
                    </div>

                    <script type="text/javascript">
                        //========= glightbox
                        GLightbox({
                            'href': 'https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM',
                            'type': 'video',
                            'source': 'youtube', //vimeo, youtube or local
                            'width': 900,
                            'autoplayVideos': true,
                        });
                    </script>

                    <script type="text/javascript">
                        //========= Hero Slider
                        tns({
                            container: '.hero-slider',
                            slideBy: 'page',
                            autoplay: true,
                            autoplayButtonOutput: false,
                            mouseDrag: true,
                            gutter: 0,
                            items: 1,
                            nav: false,
                            controls: true,
                            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
                        });

                        //======== Brand Slider
                        tns({
                            container: '.brands-logo-carousel',
                            autoplay: true,
                            autoplayButtonOutput: false,
                            mouseDrag: true,
                            gutter: 15,
                            nav: false,
                            controls: false,
                            responsive: {
                                0: {
                                    items: 1,
                                },
                                540: {
                                    items: 3,
                                },
                                768: {
                                    items: 5,
                                },
                                992: {
                                    items: 6,
                                }
                            }
                        });
                    </script>
                    <script>
                        const finaleDate = new Date("February 15, 2023 00:00:00").getTime();

                        const timer = () => {
                            const now = new Date().getTime();
                            let diff = finaleDate - now;
                            if (diff < 0) {
                                document.querySelector('.alert').style.display = 'block';
                                document.querySelector('.container').style.display = 'none';
                            }

                            let days = Math.floor(diff / (1000 * 60 * 60 * 24));
                            let hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
                            let minutes = Math.floor(diff % (1000 * 60 * 60) / (1000 * 60));
                            let seconds = Math.floor(diff % (1000 * 60) / 1000);

                            days <= 99 ? days = `0${days}` : days;
                            days <= 9 ? days = `00${days}` : days;
                            hours <= 9 ? hours = `0${hours}` : hours;
                            minutes <= 9 ? minutes = `0${minutes}` : minutes;
                            seconds <= 9 ? seconds = `0${seconds}` : seconds;

                            document.querySelector('#days').textContent = days;
                            document.querySelector('#hours').textContent = hours;
                            document.querySelector('#minutes').textContent = minutes;
                            document.querySelector('#seconds').textContent = seconds;

                        }
                        timer();
                        setInterval(timer, 1000);
                    </script>

                </div>
                <div class="col-lg-4 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                            <!-- Start Small Banner -->
                            <div class="hero-small-banner"
                                style="background-image: url('{{ asset('assets/images/backgrund-2.jpg') }}');">
                            </div>
                            <!-- End Small Banner -->
                        </div>
                        <div class="col-lg-12 col-md-6 col-12">
                            <!-- Start Small Banner -->
                            <div class="hero-small-banner style2"
                                style="background-image:url('{{ asset('assets/images/backgrund-3.jpg') }}');">
                                <div class="content">
                                    <h2>Weekly Sale!</h2>
                                    <p>Saving up to 50% off all online store items this week.</p>
                                    <div class="button">
                                        <a class="btn" href="product-grids.html">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Small Banner -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->

    <!-- Start Featured Categories Area -->
    <section class="featured-categories section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="pb-2">Featured Categories</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($categories->take(6) as $item)
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Start Single Category -->
                        <div class="single-category">
                            <h3 class="heading">{{ $item->name }}</h3>
                            <div class="images">
                                <img src="{{ $item->image_url }}" style="padding: 5px" alt="#" height="80px">
                            </div>
                        </div>
                        <!-- End Single Category -->
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- End Features Area -->

    <!-- Start Trending Product Area -->
    <section class="trending-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3>Best Selling Products</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($price_large_products->take(8) as $product)
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Start Single Product -->
                            <div class="single-product">
                                <div class="product-image">
                                    <img src="{{ $product->image_url }}" alt="#" class="img-thumbnail"
                                        style="height: 280px !important">
                                    <div class="button">
                                        <a href="{{ route('shop.products.show', $product->slug) }}" class="btn"><i
                                                class="lni lni-cart"></i> Add to Cart</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <span class="category">{{ $product->category->name }}</span>
                                    <h4 class="title">
                                        <a href="{{ route('shop.products.show', $product->slug) }}">{{ $product->name }}</a>
                                    </h4>
                                    <ul class="review">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star"></i></li>
                                        <li><span>4.0 Review(s)</span></li>
                                    </ul>
                                    <div class="price">
                                        <span>{{ $product->price_formatted }}</span>
                                        @if ($product->compare_price)
                                            <span class="discount-price">{{ $product->compare_price_formatted }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- End Trending Product Area -->

    <!-- Start Banner Area -->
    <section class="banner section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner"
                        style="background-image:url('{{ asset('assets/images/backgrund-wathce.jpg') }}')">
                        <div class="content">
                            <h2 style="color: rgba(255, 255, 255, 0.81) !important">New Wathces</h2>
                            <p class="mb-3">Order now any product in the store</p>
                            <div>
                                <a href="#" class="btn btn-light">All Watches</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner"
                        style="background-image:url('{{ asset('assets/images/backgrund-mobile.jpg') }}')">
                        <div class="content">
                            <h2 style="color: rgba(255, 255, 255, 0.845) !important">New Mobiles</h2>
                            <p class="mb-3">The latest types of mobiles in the world</p>
                            <div>
                                <a href="#" class="btn btn-light">All Watches</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Start Special Offer -->
    <section class="special-offer section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3>Special Offer</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="row">
                        @foreach ($products->take(3) as $item)
                            <div class="col-lg-4 col-md-4 col-12">
                                <!-- Start Single Product -->
                                <div class="single-product">
                                    <div class="product-image">
                                        <img src="{{ $item->image_url }}" alt="#" style="height: 220px !important">
                                        <div class="button">
                                            <a href="{{ route('shop.products.show', $item->slug) }}" class="btn"><i
                                                    class="lni lni-cart"></i> Add to
                                                Cart</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <span class="category">{{ $item->category->name }}</span>
                                        <h4 class="title">
                                            <a
                                                href="{{ route('shop.products.show', $item->slug) }}">{{ $item->name }}</a>
                                        </h4>
                                        <ul class="review">
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><span>5.0 Review(s)</span></li>
                                        </ul>
                                        <div class="price">
                                            <span>{{ $item->price_formatted }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Product -->
                            </div>
                        @endforeach
                    </div>
                    <!-- Start Banner -->
                    @foreach ($products->take(1) as $item)
                        <div class="single-banner right p-3"
                            style="background-image:url('{{ asset('assets/images/backgrund-tv.jpg') }}');margin-top: 30px;">
                            <div class="content">
                                <h4 style="color: #303030eb !important">New TVs</h4>
                                <p style="color: #585858c5 !important">The latest types of screens</p>
                                <div class="button">
                                    <a href="#" class="btn">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Banner -->
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    @foreach ($products->take(1) as $item)
                        <div class="offer-content">
                            <div class="image">
                                <img src="{{ $item->image_url }}" alt="#">
                                <span class="sale-tag">-50%</span>
                            </div>
                            <div class="text">
                                <h2><a href="product-grids.html">{{ $item->name }}</a></h2>
                                <ul class="review">
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><span>5.0 Review(s)</span></li>
                                </ul>
                                <div class="price">
                                    <span>{{ $item->price_formatted }}</span>
                                    <span class="discount-price">{{ $item->compare_price_formatted }}</span>
                                </div>
                                <p>{{ $item->short_description }}</p>
                            </div>
                            <div class="box-head">
                                <div class="box">
                                    <h1 id="days">000</h1>
                                    <h2 id="daystxt">Days</h2>
                                </div>
                                <div class="box">
                                    <h1 id="hours">00</h1>
                                    <h2 id="hourstxt">Hours</h2>
                                </div>
                                <div class="box">
                                    <h1 id="minutes">00</h1>
                                    <h2 id="minutestxt">Minutes</h2>
                                </div>
                                <div class="box">
                                    <h1 id="seconds">00</h1>
                                    <h2 id="secondstxt">Secondes</h2>
                                </div>
                            </div>
                            <div style="background: rgb(204, 24, 24);" class="alert">
                                <h1 style="padding: 50px 80px;color: white;">We are sorry, Event ended ! </h1>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- End Special Offer -->

    <!-- Start Home Product List -->
    <section class="home-product-list section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    <h4 class="list-title">Best Sellers</h4>
                    @foreach ($products->take(3) as $item)
                        <div class="single-list">
                            <div class="list-image">
                                <a href="{{ route('shop.products.show', $item->slug) }}"><img
                                        src="{{ $item->image_url }}" alt="#"></a>
                            </div>
                            <div class="list-info">
                                <h3>
                                    <a href="{{ route('shop.products.show', $item->slug) }}">{{ $item->name }}</a>
                                </h3>
                                <span>{{ $item->price_formatted }}</span>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    <h4 class="list-title">New Arrivals</h4>
                    @foreach ($products->take(3) as $item)
                        <div class="single-list">
                            <div class="list-image">
                                <a href="{{ route('shop.products.show', $item->slug) }}"><img
                                        src="{{ $item->image_url }}" alt="#"></a>
                            </div>
                            <div class="list-info">
                                <h3>
                                    <a href="{{ route('shop.products.show', $item->slug) }}">{{ $item->name }}</a>
                                </h3>
                                <span>{{ $item->price_formatted }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <h4 class="list-title">Top Rated</h4>
                    @foreach ($products->take(3) as $item)
                        <div class="single-list">
                            <div class="list-image">
                                <a href="{{ route('shop.products.show', $item->slug) }}"><img
                                        src="{{ $item->image_url }}" alt="#"></a>
                            </div>
                            <div class="list-info">
                                <h3>
                                    <a href="{{ route('shop.products.show', $item->slug) }}">{{ $item->name }}</a>
                                </h3>
                                <span>{{ $item->price_formatted }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr class="mt-4">
        </div>
    </section>
    <!-- End Home Product List -->
    <!-- Start Blog Section Area -->
    <section class="blog-section section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3>Our Latest News</h3>
                        <p>There are many variations of passages of Lorem
                            Ipsum available, but the majority have suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products->take(3) as $item)
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Start Single Blog -->
                        <div class="single-blog">
                            <div class="blog-img">
                                <a>
                                    <img src="{{ $item->image_url }}" alt="#" style="height: 400px !important">
                                </a>
                            </div>
                            <div class="blog-content">
                                <a class="category" href="javascript:void(0)">{{ $item->name }}</a>
                                <h4>
                                    <a href="#">{{ $item->price_formatted }}</a>
                                </h4>
                                <p>{{ $item->description }}</p>
                                <div class="button">
                                    <a href="{{ route('shop.products.show', $item->slug) }}" class="btn">Read More</a>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Blog -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Blog Section Area -->

    <!-- Start Shipping Info -->
    <section class="shipping-info">
        <div class="container">
            <ul>
                <!-- Free Shipping -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-delivery"></i>
                    </div>
                    <div class="media-body">
                        <h5>Free Shipping</h5>
                        <span>On order over $99</span>
                    </div>
                </li>
                <!-- Money Return -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-support"></i>
                    </div>
                    <div class="media-body">
                        <h5>24/7 Support.</h5>
                        <span>Live Chat Or Call.</span>
                    </div>
                </li>
                <!-- Support 24/7 -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="media-body">
                        <h5>Online Payment.</h5>
                        <span>Secure Payment Services.</span>
                    </div>
                </li>
                <!-- Safe Payment -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-reload"></i>
                    </div>
                    <div class="media-body">
                        <h5>Easy Return.</h5>
                        <span>Hassle Free Shopping.</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- End Shipping Info -->

@endsection
