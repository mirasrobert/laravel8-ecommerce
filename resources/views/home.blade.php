@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
    <!-- Start Hero Section -->
    <div class="container-sm">
        <header id="home-section">

            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item drk  active">
                  <img src="https://images.pexels.com/photos/34577/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="d-block w-100" alt="1st-img">
                  <div class="carousel-caption d-none d-md-block d-flex h-75 align-items-center justify-content-center">
                    <p class="text-uppercase text-danger" style="font-weight: 600">Best Offer</p>
                    <h3 class="text-uppercase" style="outline: none;">New Arrivals On Sale</h3>
                  </div>
                </div>
                <div class="carousel-item drk ">
                  <img src="https://images.pexels.com/photos/50987/money-card-business-credit-card-50987.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="d-block w-100" alt="2nd-img">
                  <div class="carousel-caption d-none d-md-block d-flex h-75 align-items-center justify-content-center">
                    <p class="text-uppercase text-danger" style="font-weight: 600">Flash Deals</p>
                    <h3 class="text-uppercase" style="outline: none;">Get Your Best Products</h3>
                  </div>
                </div>
                <div class="carousel-item drk ">
                  <img src="https://images.pexels.com/photos/230544/pexels-photo-230544.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="d-block w-100" alt="3rd-img">
                  <div class="carousel-caption d-none d-md-block d-flex h-75 align-items-center justify-content-center">
                    <p class="text-uppercase text-danger" style="font-weight: 600">Last Minute</p>
                    <h3 class="text-uppercase" style="outline: none;">Grab last Minute deals</h3>
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>

        </header>
      </div>
      <!-- End of Hero Section -->
  
      <section id="features" class="mt-5">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 fast-delivery">
                      <i class="fas fa-truck fa-2x mb-2"></i>
                      <h4 class="feature-title">Fast delivery</h4>
                      <small class="feature-p"
                        >Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Vitae praesentium, consequatur alias labore ut
                        totam.</small
                      >
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 high-secured">
                      <i class="fas fa-lock fa-2x mb-2"></i>
                      <h4 class="feature-title">High Secured</h4>
                      <small class="feature-p"
                        >Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Vitae praesentium, consequatur alias labore ut
                        totam.</small
                      >
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 authentic">
                      <i class="fas fa-shield-alt fa-2x mb-2"></i>
                      <h4 class="feature-title">Authentic</h4>
                      <small class="feature-p"
                        >Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Vitae praesentium, consequatur alias labore ut
                        totam.</small
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Start Products Section -->
      <section id="products" class="py-5 text-center">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="info-header mb-4">
                <h1 class="text-primary pb-3">Latest Products</h1>
              </div>
            </div>
          </div>
  
          <div class="row">
          @foreach ($products as $product)
          {{-- d-flex align-items-stretch --}}
            <div class="col-lg-3 col-md-4 col-sm-6 mb-1">
              <div class="card my-3">
                <div class="card-body">

                  {{-- Product Image --}}
                  <a href="/product/{{ $product->id }}">
                    <img
                    src="/storage/{{ $product->image }}"
                    alt=""
                    class="img-fluid w-50 mb-3"
                  />
                  </a>

                  <h5 class="product-title">
                  @if (strlen($product->name) > 0 && strlen($product->name) < 26) <!-- TEXT NOT BREAK OR TOO SHORT -->
                       {{ $product->name }}
                  @elseif(strlen($product->name) > 25 && strlen($product->name) < 48) <!-- EXACT -->
                       {{ $product->name }}
                  @elseif(strlen($product->name) > 48) <!-- TOO MUCH TEXT -->
                       {{ substr($product->name,0 , 48) }}...
                  @endif
                  </h5>
  
                  <!-- Star Reviews -->
                  @if($product->reviews->count() != 0)
                    <div class="d-flex justify-content-center">
                      @for ($i = 0; $i < intval(($product->reviews->sum('rate')) / ($product->reviews->count())); $i++)
                        <i class="fas fa-star checked"></i>
                      @endfor
                      <span class="text-muted ps-1">
                        {{ ($product->reviews->count() == 0) ? "0" : $product->reviews->sum('rate') / ($product->reviews->count() ) }}
                        {{ $product->reviews->count() == 1 ? $singularOfRatings : "Ratings" }}
                      </span>
                    </div>
                  @else
                      @for ($i = 0; $i < 5; $i++)
                      <i class="fas fa-star text-muted"></i>
                      @endfor
                      <span class="text-muted ps-1">
                        0 Rating
                      </span>
                  @endif
  
                  <!-- Cost -->
                  <div class="d-flex justify-content-center">
                    <p class="lead m-0 p-0 fw-bold text-secondary">${{ $product->price }}</p>
                  </div>
                </div>
                <!-- Wishlist or Cart -->
                <div class="card-footer text-muted">
                  <div class="d-flex justify-content-center">
                    <div class="p-1 ms-2">
                      <a href="#">
                        <i class="fas fa-heart"></i>
                      </a>
                    </div>
                    <div class="p-1 ms-2">
                      <a href="/product/{{ $product->id }}">
                        <i class="fas fa-cart-plus"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
            
          </div> <!-- End Row -->

          <!-- Pagination Links -->
          <div class="row">
            <div class="col mt-1">
          {{ $products->links('pagination::bootstrap-4') }}
            </div>
          </div>
          <!-- End of Pagination -->
          
          <div class="row text-center mt-3 mb-2">
            <a href="#" class="see-more text-info text-uppercase p-2">
              View All Products
              <i class="fa fa-angle-right"></i>
            </a>
          </div>

          
        </div>  <!-- End Container -->
      </section>
      <!-- End Products Section -->

@endsection
@section('extra-js')

@endsection