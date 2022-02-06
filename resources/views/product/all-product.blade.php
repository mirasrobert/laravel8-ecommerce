@extends('layouts.app')

@section('title')
    All Products
@endsection

@section('content')

    <!-- Page Content -->
    <!-- Items Starts Here -->
    <div class="featured-page">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h1>All Products</h1>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div id="filters" class="button-group">
                        <button class="btn btn-primary" data-filter="*">All Products</button>
                        <button class="btn btn-primary" data-filter=".Processor">Processor</button>
                        <button class="btn btn-primary" data-filter=".Motherboard">Motherboard</button>
                        <button class="btn btn-primary" data-filter=".Memory">Memory</button>
                        <button class="btn btn-primary" data-filter=".PSU">Power Supply</button>
                        <button class="btn btn-primary" data-filter=".Mouse">Mouse</button>
                        <button class="btn btn-primary" data-filter=".Keyboard">Keyboard</button>
                        <button class="btn btn-primary" data-filter=".GPU">Graphics Card</button>
                        <button class="btn btn-primary" data-filter=".Monitor">Monitor</button>
                        <button class="btn btn-primary" data-filter=".Laptop">Laptop</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="featured container no-gutter">

        <div class="row posts">
            @foreach ($products as $product)
                <div id="{{ $product->id }}"
                     class="item {{ $product->category }}
                     {{ (\Carbon\Carbon::now()->between($product->created_at, $product->created_at->addDays(2))) ? 'new' : ''}}
                         col-md-4"
                >
                    <a href="/product/{{ $product->id }}/{{ $product->slug }}">
                        <div class="featured-item">
                            <img src="{{ $product->photos[0]->url }}" width="308" height="233">

                            <h4>
                                @if (strlen($product->name) > 0 && strlen($product->name) < 49)
                                    <br>{{ substr($product->name,0 , 48) }}<br>
                                @elseif(strlen($product->name) > 48) <!-- TOO MUCH TEXT -->
                                {{ substr($product->name,0 , 45) }}...
                                @endif
                            </h4>

                            <h6>&#8369;{{ $product->price }}</h6>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="page-pagination">
        <div class="container justify-content-center">
            <div class="row  justify-content-center">
                <div class="col-12">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <!-- Featred Page Ends Here -->

@endsection
