@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
    <!-- Start Hero Section -->
    <div class="container-sm">
        <header id="home-section">
          <!-- BG image goes section -->
          <div class="dark-overlay">
            <!-- BG image dark overlay -->
            <div class="home-inner">
              <!-- Wrap content to container -->
              <div class="row mx-auto">
                <div class="col-lg-9 col-md-12 col-sm-12 mx-auto">
                  <h1 class="display-4 text-center">
                    Build <strong>social profiles</strong> and gain revenue and
                    <strong>profits</strong>
                  </h1>
                  <div class="nav-hr my-3"></div>
                  <div class="d-flex">
                    <p>
                      Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                      Quasi sit provident, temporibus aut ad iusto atque esse sint
                      excepturi soluta cum qui. Dolorum atque nihil magni harum,
                      distinctio quod consequatur?
                    </p>
                  </div>
  
                  <div class="d-flex">
                    <div class="align self-start">
                      <a href="" class="btn btn-primary text-uppercase p-2 me-2"
                        >Getting Started</a
                      >
                    </div>
                    <div class="align-self-end">
                      <a href="" class="btn btn-primary text-uppercase p-2 me-2"
                        >Shop More</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>
      </div>
      <!-- End of Hero Section -->
  
      <section id="features" class="my-5">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <i class="fas fa-truck fa-2x"></i>
                      <h4 class="feature-title">Fast delivery</h4>
                      <small class="feature-p"
                        >Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Vitae praesentium, consequatur alias labore ut
                        totam.</small
                      >
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <i class="fas fa-lock fa-2x"></i>
                      <h4 class="feature-title">High Secured</h4>
                      <small class="feature-p"
                        >Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Vitae praesentium, consequatur alias labore ut
                        totam.</small
                      >
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <i class="fas fa-shield-alt fa-2x"></i>
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
      <section id="products" class="my-4 text-center">
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
              
            <div class="col-lg-3 col-md-6">
              <div class="card my-3">
                <div class="card-body">
                  <img
                    src="/storage/{{ $product->image }}"
                    alt=""
                    class="img-fluid w-50 mb-3"
                  />
                  
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
                  <div class="d-flex justify-content-center">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <span class="text-muted ps-1">0 reviews</span>
                  </div>
  
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
          
        </div>  <!-- End Container -->
      </section>
      <!-- End Products Section -->
  
      <!-- Start Products Section -->
      <section id="products-2" class="my-5 text-center">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="info-header mb-5">
                <h1 class="text-primary pb-3">Recommended</h1>
              </div>
            </div>
          </div>
  
          <div class="row">
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <img
                    src="img/clothes/16.jpg"
                    alt=""
                    class="img-fluid w-50 mb-3"
                  />
                  <h5 class="product-title">
                    Lenovo Tab M10 Plus, 10.3" FHD Android Tablet
                  </h5>
  
                  <!-- Star Reviews -->
                  <div class="d-flex justify-content-center">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <span class="text-muted ps-1">0 reviews</span>
                  </div>
  
                  <!-- Cost -->
                  <div class="d-flex justify-content-center">
                    <p class="lead m-0 p-0 fw-bold text-secondary">$364.99</p>
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
                      <a href="#">
                        <i class="fas fa-cart-plus"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <img
                    src="img/clothes/12.jpg"
                    alt=""
                    class="img-fluid w-50 mb-3"
                  />
                  <h5 class="product-title">
                    Lenovo Tab M10 Plus, 10.3" FHD Android Tablet
                  </h5>
  
                  <!-- Star Reviews -->
                  <div class="d-flex justify-content-center">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <span class="text-muted ps-1">0 reviews</span>
                  </div>
  
                  <!-- Cost -->
                  <div class="d-flex justify-content-center">
                    <p class="lead m-0 p-0 fw-bold text-secondary">$364.99</p>
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
                      <a href="#">
                        <i class="fas fa-cart-plus"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <img
                    src="img/clothes/13.jpg"
                    alt=""
                    class="img-fluid w-50 mb-3"
                  />
                  <h5 class="product-title">
                    Acer Swift 3 Thin & Light Laptop, 14" Full HD IPS
                  </h5>
  
                  <!-- Star Reviews -->
                  <div class="d-flex justify-content-center">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <span class="text-muted ps-1">0 reviews</span>
                  </div>
  
                  <!-- Cost -->
                  <div class="d-flex justify-content-center">
                    <p class="lead m-0 p-0 fw-bold text-secondary">$364.99</p>
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
                      <a href="#">
                        <i class="fas fa-cart-plus"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <img
                    src="img/clothes/18.jpg"
                    alt=""
                    class="img-fluid w-50 mb-3"
                  />
                  <h5 class="product-title">
                    MobileDemand Flex 10B Rugged Touchscreen Tablet
                  </h5>
  
                  <!-- Star Reviews -->
                  <div class="d-flex justify-content-center">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <span class="text-muted ps-1">0 reviews</span>
                  </div>
  
                  <!-- Cost -->
                  <div class="d-flex justify-content-center">
                    <p class="lead m-0 p-0 fw-bold text-secondary">$364.99</p>
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
                      <a href="#">
                        <i class="fas fa-cart-plus"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Products Section -->
@endsection
