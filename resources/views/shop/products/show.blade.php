@extends('layouts.shop')
@section('title', 'Product Show')

@section('content')




    <section class="item-details section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    @if (session()->has('success'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                            </svg>
                            &nbsp;&nbsp; | {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="top-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img">
                                    <img src="{{ $product->image_url }}" id="current" alt="#">
                                </div>
                                @if ($gallery)
                                    <div class="images">
                                        @foreach ($gallery as $image)
                                            <img src="{{ $image->url }}" class="img" alt="#">
                                        @endforeach
                                    </div>
                                @endif
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <h2 class="title">{{ $product->name }}</h2>
                            <p class="category"><i class="lni lni-tag"></i> category:<a
                                    href="javascript:void(0)">{{ $product->category->name }}</a></p>
                            <h3 class="price">{{ $product->price_formatted }}
                                @if ($product->compare_price)
                                    <span>{{ $product->compare_price_formatted }}</span>
                            </h3>
                            @endif
                            <p class="info-text">{{ $product->short_description }}</p>
                            <form action="{{ route('cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="form-group color-option">
                                            <label class="title-label" for="size">Choose color</label>
                                            <div class="single-checkbox checkbox-style-1">
                                                <input type="checkbox" id="checkbox-1" checked>
                                                <label for="checkbox-1"><span></span></label>
                                            </div>
                                            <div class="single-checkbox checkbox-style-2">
                                                <input type="checkbox" id="checkbox-2">
                                                <label for="checkbox-2"><span></span></label>
                                            </div>
                                            <div class="single-checkbox checkbox-style-3">
                                                <input type="checkbox" id="checkbox-3">
                                                <label for="checkbox-3"><span></span></label>
                                            </div>
                                            <div class="single-checkbox checkbox-style-4">
                                                <input type="checkbox" id="checkbox-4">
                                                <label for="checkbox-4"><span></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="color">Battery capacity</label>
                                            <select class="form-control" id="color">
                                                <option>5100 mAh</option>
                                                <option>6200 mAh</option>
                                                <option>8000 mAh</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="form-group quantity">
                                            <label for="color">Quantity</label>
                                            <select class="form-control" name="quantity">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom-content">
                                    <div class="row align-items-end">
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="button cart-button">
                                                <button class="btn" type="submit" style="width: 100%;">Add to
                                                    Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-details-info">
                <div class="single-block">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="info-body custom-responsive-margin">
                                <h4>Details</h4>
                                <p>{{ $product->description }}</p>
                                <h4>Features</h4>
                                <ul class="features">
                                    <li>Capture 4K30 Video and 12MP Photos</li>
                                    <li>Game-Style Controller with Touchscreen</li>
                                    <li>View Live Camera Feed</li>
                                    <li>Full Control of HERO6 Black</li>
                                    <li>Use App for Dedicated Camera Operation</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="info-body">
                                <h4>Specifications</h4>
                                <ul class="normal-list">
                                    <li><span>Weight:</span> 35.5oz (1006g)</li>
                                    <li><span>Maximum Speed:</span> 35 mph (15 m/s)</li>
                                    <li><span>Maximum Distance:</span> Up to 9,840ft (3,000m)</li>
                                    <li><span>Operating Frequency:</span> 2.4GHz</li>
                                    <li><span>Manufacturer:</span> GoPro, USA</li>
                                </ul>
                                <h4>Shipping Options:</h4>
                                <ul class="normal-list">
                                    <li><span>Courier:</span> 2 - 4 days, $22.50</li>
                                    <li><span>Local Shipping:</span> up to one week, $10.00</li>
                                    <li><span>UPS Ground Shipping:</span> 4 - 6 days, $18.00</li>
                                    <li><span>Unishop Global Export:</span> 3 - 4 days, $25.00</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="single-block">
                            <div class="reviews">
                                <div class="d-flex justify-content-between">
                                    <div class="flex">
                                        <h4 class="title">Latest Reviews</h4>
                                    </div>
                                    <div class="flex">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Leave a Review
                                        </button>
                                    </div>
                                </div>



                                @foreach ($product->reviews->take(3) as $item)
                                    <div class="single-review">
                                        <img src="{{ asset('assets/images/users.jpg') }}" width="130px" alt="#">
                                        <div class="review-info">
                                            <h4>{{ $item->subject }}
                                                <span>{{ $item->name }}</span>
                                            </h4>
                                            <ul class="stars">
                                                <li><i class="lni lni-star-filled"></i></li>
                                                <li><i class="lni lni-star-filled"></i></li>
                                                <li><i class="lni lni-star-filled"></i></li>
                                                <li><i class="lni lni-star-filled"></i></li>
                                                <li><i class="lni lni-star-filled"></i></li>
                                            </ul>
                                            <p>{{ $item->description }}</p>
                                        </div>
                                    </div>
                                @endforeach

                                @if ($product->reviews->count() > 3)
                                    <button style="font-size: 12px !important; border: none"
                                        class="btn btn-outline-secondary">Show More</button>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>

                @if (count(
                        $product->category->products()->where('id', '<>', $product->id)->get()) > 0)
                    <hr>
                    <div>
                        <h2 class="section-title">Similar Products</h2>
                        <div class="row">
                            @foreach ($product->category->products()->where('id', '<>', $product->id)->get() as $similar_products)
                                <div class="col-lg-3 col-md-6 col-12">
                                    <!-- Start Single Product -->
                                    <div class="single-product">
                                        <div class="product-image">
                                            <img src="{{ $similar_products->image_url }}" alt="#"
                                                class="img-thumbnail">
                                            <div class="button">
                                                <a href="{{ route('shop.products.show', $similar_products->slug) }}"
                                                    class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <span class="category">{{ $similar_products->category->name }}</span>
                                            <h4 class="title">
                                                <a
                                                    href="{{ route('shop.products.show', $similar_products->slug) }}">{{ $similar_products->name }}</a>
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
                                                {{ $similar_products->price_formatted }}
                                                @if ($similar_products->compare_price)
                                                    <span
                                                        class="discount-price">{{ $similar_products->compare_price_formatted }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Single Product -->
                                </div>
                            @endforeach
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Review Modal -->
    <div class="modal fade review-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="{{ route('reviews.store', $product->id) }}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Leave a Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{--  <label for="name">Your Name</label>  --}}
                                    <input class="form-control" type="hidden"
                                        value="@if (auth()->check()) {{ $product->user->profile->first_name }} {{ $product->user->profile->last_name }} @endif"
                                        name="name" id="name" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{--  <label for="email">Your Email</label>  --}}
                                    <input class="form-control" type="hidden"
                                        value="@if (auth()->check()) {{ Auth::user()->profile->user->email }} @endif"
                                        name="email" id="email" readonly>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        name="subject" id="subject" value="{{ old('subject') }}">
                                    @error('name')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="rating">Rating</label>
                                    <select class="form-control" name="rating" id="rating">
                                        <option value="star5">5 Stars</option>
                                        <option value="star4">4 Stars</option>
                                        <option value="star3">3 Stars</option>
                                        <option value="star2">2 Stars</option>
                                        <option value="star1">1 Star</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Review</label>
                            <textarea class="form-control @error('name') is-invalid @enderror" id="description" name="description"
                                rows="6">{{ old('description') }}</textarea>
                            @error('name')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer button">
                        <button type="submit" class="btn">Send Review</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End Review Modal -->

@endsection
