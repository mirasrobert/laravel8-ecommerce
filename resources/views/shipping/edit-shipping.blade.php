@extends('layouts.app')

@section('title')
    Shipping
@endsection

@section('content')

<section id="shipping">
    <!-- ============================ COMPONENT SHIPPING   ================================= -->
    <div class="card mx-auto" style="max-width: 520px; margin-top: 40px">
      <article class="card-body">
        <header class="mb-4">
            <h4 class="card-title">
            Edit Address / Shipping
            <span class="float-right"> <a href="{{ route('my_orders') }}">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                  Back
                </a>
            </span>
            </h4>
        </header>
        <form method="POST" action="{{ route('shipping.update') }}">
          @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="col form-group mb-3">
              <label>Address</label>
              <input type="text" id="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ auth()->user()->shipping->address }}" autocomplete="address" autofocus placeholder="House/Unit/Flr #, Bldg Name, Blk or Lot #" />

              @error('address')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-group mb-3">
            <label>Contact</label>
            <input type="number" id="contact" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ auth()->user()->shipping->contact }}" autocomplete="contact" autofocus placeholder="+639XX-XXX-YYYY" />
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
            <div class="form-group col-md-12 mb-3">
              <label>Province</label>
              <select id="province" name="province" class="form-control province @error('province') is-invalid @enderror" name="province" value="{{ old('province') }}" autocomplete="province" autofocus data-dependent="city">
                <option selected="{{ $selectedProvince->provCode }}" value="{{ $selectedProvince->provCode }}">{{ $selectedProvince->provDesc }}</option>
                @foreach ($provinces as $province)
                <option value="{{ $province->provCode }}">{{ $province->provDesc }}</option>
                @endforeach

              </select>

              @error('province')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12 mb-3">
              <label>City/Municipality</label>
              <select id="city" name="city" class="form-control city @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" autocomplete="city" autofocus data-dependent="barangay">
                <option selected="{{ $selectedCity->citymunDesc }}" value="{{ $selectedCity->citymunCode }}">{{ $selectedCity->citymunDesc }}</option>

              </select>

              @error('city')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group col-md-12 mb-3">
              <label>Barangay</label>
              <select id="barangay" name="barangay" class="form-control barangay @error('barangay') is-invalid @enderror" name="barangay" value="{{ old('barangay') }}" autocomplete="barangay" autofocus>
                <option selected="{{ $selectedBrgy->brgyDesc }}" value="{{ $selectedBrgy->brgyCode }}">{{ $selectedBrgy->brgyDesc }}</option>
              </select>

              @error('barangay')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <!-- form-group end.-->
          </div>
          <!-- form-row -->


            <button type="submit" id="shipping-btn" class="btn btn-primary btn-block">
              Update
            </button>

        </form>
      </article>
      <!-- card-body. -->
    </div>
    <!-- card  -->
    <br /><br />
    <!-- ============================ COMPONENT REGISTER  END.// ================================= -->
  </section>

@endsection

@section('extra-js')
  <script src="{{ asset('js/address.js') }}"></script>
@endsection
