<div>
    <section id="user-profile">
        <div class="container">
    
          @if( session('status') )
          <div class="alert alert-success alert-dismissible mt-3">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ session('status')  }}  
          </div>
          @endif
    
            <div class="row pt-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">
                              Personal Profile |
                              <span><a href="{{ route('user.edit') }}" class="card-link">Edit</a></span>
                          </h5>
                          
                          <p class="card-text mb-2">Name: {{ auth()->user()->name }}</p>
                          <p class="card-text mb-2">Email: {{ auth()->user()->email }}</p>
                          <p class="card-text">Member since: {{ auth()->user()->created_at }}</p>
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">
                              Address |
                        @if(!is_null(auth()->user()->shipping))
                              <span><a href="{{ route('shipping.edit') }}" class="card-link">Edit</a></span>
                          </h5>
                          
                          <p class="card-text mb-2">Address: {{ auth()->user()->shipping->address }} {{ auth()->user()->shipping->province }}</p>
                          <p class="card-text mb-2">Province: {{ $selectedProvince->provDesc }}</p>
                          <p class="card-text mb-2">City/Municipality: {{ $selectedCity->citymunDesc }}</p>
                          <p class="card-text mb-2">Barangay: {{ $selectedBrgy->brgyDesc }}</p>
                          <p class="card-text">Contact: {{ auth()->user()->shipping->contact }}</p>
                        @else
                        <span><a href="{{ route('shipping.store') }}" class="card-link">Add Address</a></span>
                        @endif
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </section>
</div>