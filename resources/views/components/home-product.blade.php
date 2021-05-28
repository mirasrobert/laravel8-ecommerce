<div class="owl-carousel owl-theme">
              
    @foreach ($products as $key => $product)
    <a href="/product/{{ $product->id }}/{{ $product->slug }}">
      <div class="featured-item">

        <img src="/storage/{{ $product->image }}" alt="Item {{ $key }}" width="220" height="206" />

        <h4>
          @if (strlen($product->name) > 25 && strlen($product->name) < 45)
             {{ $product->name }}
          @elseif(strlen($product->name) > 45) <!-- TOO MUCH TEXT -->
             {{ substr($product->name,0 , 45) }}...
          @else
             <br /> {{ $product->name }} <br />
          @endif
        </h4>

        <h6>${{ $product->price }}.00</h6>

        <p> 
          {{ Str::plural('Review', $product->reviews->count()) }}
          ({{ $product->reviews->count() }})
        </p>

        @if($product->reviews->count() != 0)
          <div class="d-flex justify-content-start">
            @for ($i = 0; $i < intval(($product->reviews->sum('rate')) / ($product->reviews->count())); $i++)
              <i class="fa fa-star checked"></i>
            @endfor
          </div>
        @else
          <div class="d-flex justify-content-start">
            @for ($i = 0; $i < 5; $i++)
              <i class="fa fa-star gray"></i>
            @endfor
          </div>
        @endif

      </div>
    </a>
    @endforeach
    
  </div>