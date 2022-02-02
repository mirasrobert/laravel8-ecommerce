@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner">
        <div class="container">
            <div id="carouselExampleCaptions" class="carousel slide bg-dark" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">

                    @foreach($topProducts as $product)
                        <div class="carousel-item {{ $loop->first ? 'active' : NULL }}">
                            <img
                                src="{{ $product->image }}"
                                class="img-fluid" alt="...">
                            <div class="carousel-caption ">
                                <h2>{{ $product->name }} (&#8369;{{ $product->price }}
                                    )</h2>
                            </div>
                        </div>
                    @endforeach

                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Banner Ends Here -->

    <!-- Featured Starts Here -->
    <div class="featured-items">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h1>Featured Items</h1>
                        <div class="ml-auto">
                            <a href="{{ route('product.view') }}">View all products <i
                                    class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">

                    <x-home-product :products="$products"/>

                </div>
            </div>
        </div>
    </div>
    <!-- Featred Ends Here -->

    <!-- Subscribe Form Starts Here -->
    <div class="subscribe-form">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h1>Subscribe on {{ env('APP_NAME') }} now!</h1>
                    </div>
                </div>
                <div class="col-md-8 offset-md-2">
                    <div class="main-content">
                        <p>
                            Integer vel turpis ultricies, lacinia ligula id, lobortis augue.
                            Vivamus porttitor dui id dictum efficitur. Phasellus vel
                            interdum elit.
                        </p>
                        <div class="container">
                            <form id="subscribe" action="" method="get">
                                <div class="row">
                                    <div class="col-md-7">
                                        <fieldset>
                                            <input
                                                name="email"
                                                type="text"
                                                class="form-control"
                                                id="email"
                                                onfocus="if(this.value == 'Your Email...') { this.value = ''; }"
                                                onBlur="if(this.value == '') { this.value = 'Your Email...';}"
                                                value="Your Email..."
                                                required=""
                                            />
                                        </fieldset>
                                    </div>
                                    <div class="col-md-5">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="button">
                                                Subscribe Now!
                                            </button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Subscribe Form Ends Here -->
@endsection
