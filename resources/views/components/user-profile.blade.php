<div class="container">
    <div class="row gutters py-5">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar d-flex justify-content-center">
                                <img
                                    id="user-profile-image"
                                    src="{{ auth()->user()->avatar }}"
                                    class="img-fluid" alt="user-avatar" width="100" height="100">
                            </div>
                            <div class="user-name mt-3">
                                <h5 class="user-name text-center">{{ auth()->user()->name }}</h5>
                                <h6 class="user-email text-center">{{ auth()->user()->email }}</h6>
                            </div>
                        </div>
                        <div class="buttons d-flex flex-column">
                            <button type="button" class="btn btn-info mb-2" id="avatar_edit">
                                <i class="far fa-image"></i>
                                Change photo
                            </button>

                            <form id="avatar_form" enctype="multipart/form-data" method="POST"
                                  style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="file" class="d-none" name="avatar" id="avatar"/>
                            </form>

                            @if(!auth()->user()->provider_id)
                                <a href="{{ route('user.changePassword') }}" type="button" class="btn btn-success mb-2">
                                    <i class="fas fa-key"></i>
                                    Change Password
                                </a>
                            @endif
                            <button class="btn btn-danger" type="button" id="deleteAccountBtn">
                                <i class="fas fa-user-times"></i>
                                Delete Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <form method="POST" action="{{ route('user.update', auth()->user()->id) }}" class="d-inline-block">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Personal Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           id="fullName"
                                           placeholder="Enter full name" value="{{ auth()->user()->name }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="eMail">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" id="eMail" placeholder="Enter email ID"
                                           value="{{ auth()->user()->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div
                                class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-between">
                                <h6 class="mt-3 mb-2 text-primary">
                                    Address
                                    @if(auth()->user()->shipping)
                                        <a href="{{ route('shipping.edit') }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('shipping.store') }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    @endif
                                </h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="Street">Street</label>
                                    <input type="name" class="form-control" id="Street" placeholder="Enter Street"
                                           value="{{ auth()->user()->shipping->address ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ciTy">City</label>
                                    <input type="name" class="form-control" id="ciTy" placeholder="Enter City"
                                           value="{{ $selectedCity->citymunDesc ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="sTate">State/Barangay</label>
                                    <input type="text" class="form-control" id="sTate" placeholder="Enter State"
                                           value="{{ $selectedBrgy->brgyDesc ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="zIp">Province</label>
                                    <input type="text" class="form-control" id="province"
                                           placeholder="Your province"
                                           value="{{ $selectedProvince->provDesc ?? '' }}" readonly>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input type="name" class="form-control" id="contact" placeholder="Enter Contact"
                                           value="{{ auth()->user()->shipping->contact ?? '' }} " readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <a href="{{ route('home') }}" class="btn btn-secondary">
                                        Cancel
                                    </a>
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
