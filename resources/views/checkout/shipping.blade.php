@extends('layouts.app')

@section('title')
    Shipping
@endsection

@section('content')

<section id="shipping">
    <!-- ============================ COMPONENT SHIPPING   ================================= -->
    <div class="card mx-auto" style="max-width: 520px; margin-top: 40px">
      <article class="card-body">
        <header class="mb-4"><h4 class="card-title">Shipping</h4></header>
        <form method="POST" action="{{ route('shipping.store') }}">
          @csrf
          <div class="form-row">
            <div class="col form-group mb-3">
              <label>Address</label>
              <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus />

              @error('address')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="col form-group mb-3">
              <label>Postal Code</label>
              <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal_code" autofocus />

              @error('postal_code')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
              </div>
   
          </div>

          <div class="form-group mb-3">
            <label>Contact</label>
            <input type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus />
            <small class="form-text text-muted"
              >We'll never share your contact with anyone else.</small
            >

            @error('contact')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-row">
            <div class="form-group mb-3 col-md-12">
              <label>City</label>
              <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus />

              @error('city')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          <div class="form-row">
            <div class="form-group mb-3 col-md-12">
              <label>Province</label>
              <input type="text" class="form-control @error('province') is-invalid @enderror" name="province" value="{{ old('province') }}" required autocomplete="province" autofocus />

              @error('province')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group col-md-12 mb-3">
              <label>Country</label>
              <select id="inputState" name="country" class="form-control @error('province') is-invalid @enderror" name="province" value="{{ old('province') }}" required autocomplete="province" autofocus>
                <option selected="" disabled>Choose...</option>
                <option value="Philippines">Philippines</option>
                <option value="Japan">Japan</option>
                <option value="United States">United States</option>
                <option value="India">India</option>
                <option value="Korea">Africa</option>
              </select>

              @error('province')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <!-- form-group end.-->
          </div>
          <!-- form-row -->

          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">
              Continue
            </button>
          </div>
        </form>
      </article>
      <!-- card-body. -->
    </div>
    <!-- card  -->
    <br /><br />
    <!-- ============================ COMPONENT REGISTER  END.// ================================= -->
  </section>

@endsection
