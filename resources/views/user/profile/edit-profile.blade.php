@extends('layouts.app')

@section('title')
    Edit Profile
@endsection

@section('content')

<section id="shipping">
    <!-- ============================ COMPONENT PROFILE   ================================= -->
    <div class="container">

        @if( session('error') )
              <div class="alert alert-danger alert-dismissible mt-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {{ session('error')  }}  
              </div>
        @endif

        <div class="card mx-auto" style="max-width: 520px; margin-top: 40px">
            <article class="card-body">
              <header class="mb-4">
                <h4 class="card-title">
                  User Profile
                  <span class="float-right"> <a href="{{ route('user.changePassword') }}">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      Change password
                    </a> 
                </span>
                </h4>
              </header>
              <form method="POST" action="/profile/{{ auth()->user()->id }}">
                @csrf
                @method('PATCH')
      
                <div class="form-row">
                  <div class="form-group mb-3 col-md-12">
                    <label>Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}" autocomplete="name" autofocus />
      
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
      
                <div class="form-row">
                  <div class="form-group mb-3 col-md-12">
                    <label>Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}" autocomplete="email" autofocus />
      
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
      
                <div class="form-row">
                  <div class="form-group mb-3 col-md-12">
                    <label>Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password" autofocus />
      
                    <small class="form-text text-muted"
                    >Please type your password to update your profile.</small
                  >
      
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
      
                <div class="form-row">
                  <div class="form-group mb-3 col-md-12">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="password_confirmation" autofocus />
      
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
      
      
                <button type="submit" name="submit" class="btn btn-primary btn-block">
                  Update
                </button>
              </form>
            </article>
            <!-- card-body. -->
          </div>
    </div>
    <!-- card  -->
    <br /><br />
    <!-- ============================ COMPONENT PROFILE  END.// ================================= -->
  </section>

@endsection
