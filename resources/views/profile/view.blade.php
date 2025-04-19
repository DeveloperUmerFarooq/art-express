@extends('layouts.' . $role . 'Layout.layout')

@section('page')
<div class="container-fluid py-4">
    <!-- Profile Header -->
    <div class="card profile-card bg-transparent shadow-sm border-0 rounded-lg mb-4">
        <div class="card-body p-4">
            <!-- Avatar Section -->
            <div class="text-center mb-4">
                <div class="position-relative d-inline-block">
                    <img loading="lazy" class="rounded-circle shadow"
                         src="{{asset('storage/users-avatar/'.$profile->user->avatar)}}"
                         alt="Profile Image"
                         style="width: 150px; height: 150px; object-fit: cover;">
                </div>

                <h2 class="mt-3 mb-1">
                    <i class="fas fa-user-circle me-2 text-primary"></i>
                    {{$profile->user->name}}
                </h2>

                <h4 class="text-muted">
                    <i class="fas fa-envelope me-2 text-secondary"></i>
                    {{$profile->user->email}}
                </h4>

                <!-- Social Links -->
                @if ($profile->facebook_link || $profile->instagram_link || $profile->linkedin_link || $profile->twitter_link)
                <div class="d-flex justify-content-center align-items-center mt-3">
                    @if($profile->facebook_link)
                    <a href="{{$profile->facebook_link}}" target="_blank" rel="noopener noreferrer" class="mx-2 text-primary">
                        <i class="fab fa-facebook fa-2x"></i>
                    </a>
                    @endif

                    @if($profile->instagram_link)
                    <a href="{{$profile->instagram_link}}" target="_blank" rel="noopener noreferrer" class="mx-2 text-danger">
                        <i class="fab fa-instagram fa-2x"></i>
                    </a>
                    @endif

                    @if($profile->twitter_link)
                    <a href="{{$profile->twitter_link}}" target="_blank" rel="noopener noreferrer" class="mx-2 text-info">
                        <i class="fab fa-twitter fa-2x"></i>
                    </a>
                    @endif

                    @if($profile->linkedin_link)
                    <a href="{{$profile->linkedin_link}}" target="_blank" rel="noopener noreferrer" class="mx-2 text-primary">
                        <i class="fab fa-linkedin fa-2x"></i>
                    </a>
                    @endif
                </div>
                @endif
            </div>

            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
                <div class="container-fluid">
                    <span class="navbar-brand fw-bold text-light">
                        <i class="fas fa-id-card me-2"></i>Personal Details
                    </span>
                    @if (auth()->user()->hasRole('admin') && $profile->user->hasRole('artist'))
                    <div class="ms-auto">
                        <a href="{{route('admin.profile.view',$profile->user->id)}}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-briefcase me-1"></i>View Portfolio
                        </a>
                    </div>
                    @endif
                </div>
            </nav>
        </div>
    </div>

    <!-- Profile Details -->
    <div class="card profile-card bg-transparent shadow-sm border-0 rounded-lg">
        <div class="card-body p-4">
            <div class="row g-3 mb-3">
                <!-- Name -->
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control bg-light text-black"
                               placeholder="Name" value="{{$profile->user->name}}" disabled>
                        <label class="text-muted">
                            <i class="fas fa-user me-2"></i>Full Name
                        </label>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="email" class="form-control bg-light text-black"
                               placeholder="Email" value="{{$profile->user->email}}" disabled>
                        <label class="text-muted">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                    </div>
                </div>

                <!-- Phone -->
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="tel" class="form-control bg-light text-black"
                               placeholder="Phone" value="{{$profile->phone_number}}" disabled>
                        <label class="text-muted">
                            <i class="fas fa-phone me-2"></i>Phone Number
                        </label>
                    </div>
                </div>

                <!-- CNIC -->
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control bg-light text-black"
                               placeholder="CNIC" value="{{$profile->cnic}}" disabled>
                        <label class="text-muted">
                            <i class="fas fa-id-card me-2"></i>CNIC
                        </label>
                    </div>
                </div>

                <!-- Country -->
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control bg-light text-black"
                               placeholder="Country" value="{{$profile->country}}" disabled>
                        <label class="text-muted">
                            <i class="fas fa-globe me-2"></i>Country
                        </label>
                    </div>
                </div>

                <!-- City -->
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control bg-light text-black"
                               placeholder="City" value="{{$profile->city}}" disabled>
                        <label class="text-muted">
                            <i class="fas fa-city me-2"></i>City
                        </label>
                    </div>
                </div>

                <!-- Bio -->
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control bg-light text-black"
                                  placeholder="Bio" style="height: 100px" disabled>{{$profile->bio}}</textarea>
                        <label class="text-muted">
                            <i class="fas fa-info-circle me-2"></i>Bio
                        </label>
                    </div>
                </div>

                <!-- Address -->
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control bg-light text-black"
                                  placeholder="Address" style="height: 100px" disabled>{{$profile->address}}</textarea>
                        <label class="text-muted">
                            <i class="fas fa-map-marker-alt me-2"></i>Address
                        </label>
                    </div>
                </div>
            </div>

            @if(auth()->user()->id === $profile->user->id)
            <div class="text-center mt-4">
                <a href="{{route($role.'.profile.index')}}" class="btn btn-primary px-4">
                    <i class="fas fa-edit me-2"></i>Edit Profile
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
