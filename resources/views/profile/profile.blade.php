@extends('layouts.' . $role . 'Layout.layout')
@section('title')
    Profile | Art-Express
@endsection
@section('page')
<div class="container-fluid py-4">
    <!-- Profile Header -->
    <div class="card profile-card bg-transparent shadow-sm border-0 rounded-lg mb-4">
        <div class="card-body">
            <!-- Avatar Section -->
            <div class="text-center mb-4">
                <div class="position-relative d-inline-block">
                    <img loading="lazy" class="rounded-circle shadow"
                         src="{{asset('storage/users-avatar/'.auth()->user()->avatar)}}"
                         alt="Profile Image"
                         style="width: 150px; height: 150px; object-fit: cover;">

                    @can('manage profile')
                    <div class="position-absolute bottom-0 end-0 bg-dark rounded-circle shadow-lg p-2"
                         style="cursor:pointer"
                         onclick="document.getElementById('fileInput').click();">
                        <i class="fas fa-pencil text-white"></i>
                        <form action="{{route($role.'.avatar')}}" method="POST" class="d-none" id="avatar-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{auth()->user()->id}}">
                            <input type="file" name="avatar" id="fileInput" accept="images/*" onchange="document.getElementById('avatar-form').submit();">
                        </form>
                    </div>
                    @endcan
                </div>

                <h2 class="mt-3 mb-1">
                    <i class="fas fa-user-circle me-2 text-primary"></i>
                    {{auth()->user()->name}}
                </h2>

                <h4 class="text-muted">
                    <i class="fas fa-envelope me-2 text-secondary"></i>
                    {{auth()->user()->email}}
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

                    @can('manage profile')
                    <a href="#" data-bs-toggle="modal" data-bs-target="#Edit-Social-Links" class="mx-2 text-secondary">
                        <i class="fas fa-edit fa-lg fs-4" title="Edit Social Links"></i>
                    </a>
                    @endcan
                </div>
                @else
                @can('manage profile')
                <button class="btn btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#Add-Social-Links">
                    <i class="fas fa-plus me-2"></i>Add Social Links
                </button>
                @endcan
                @endif
            </div>

            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
                <div class="container-fluid">
                    <span class="navbar-brand fw-bold text-light">
                        <i class="fas fa-id-card me-2"></i>Personal Details
                    </span>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#profileNav">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="profileNav">
                        <ul class="navbar-nav ms-auto">
                            @if (auth()->user()->hasRole('artist'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('artist.profile.index')}}">
                                    <i class="fas fa-briefcase me-1"></i>Portfolio
                                </a>
                            </li>
                            @endif

                            @can('manage profile')
                            <li class="nav-item">
                                <a class="nav-link" id="edit-details" href="#">
                                    <i class="fas fa-edit me-1"></i>Edit Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#Change-Password">
                                    <i class="fas fa-key me-1"></i>Update Password
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Profile Form -->
    <div class="card profile-card bg-transparent shadow-sm border-0 rounded-lg">
        <div class="card-body">
            <form action="{{route($role.'.details.update')}}" method="POST" id="profile">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{auth()->user()->id}}">

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="name" id="name" class="form-control"
                                   placeholder="Name" value="{{auth()->user()->name}}" disabled>
                            <label for="name" class="form-label">
                                <i class="fas fa-user me-2 text-muted"></i>Full Name
                            </label>
                            @error('name')
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" name="email" id="email" class="form-control"
                                   placeholder="Email" value="{{auth()->user()->email}}" disabled>
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2 text-muted"></i>Email Address
                            </label>
                            @error('email')
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="tel" name="phone_number" id="phone-number" class="form-control"
                                   placeholder="Phone" value="{{$profile->phone_number}}" disabled>
                            <label for="phone-number" class="form-label">
                                <i class="fas fa-phone me-2 text-muted"></i>Phone Number
                            </label>
                            @error('phone_number')
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="cnic" id="cnic" class="form-control"
                                   placeholder="CNIC" value="{{$profile->cnic}}" disabled>
                            <label for="cnic" class="form-label">
                                <i class="fas fa-id-card me-2 text-muted"></i>CNIC
                            </label>
                            @error('cnic')
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" value="Pakistan" name="country" id="country" class="form-control"
                                   placeholder="Country" disabled>
                            <label for="country" class="form-label">
                                <i class="fas fa-globe me-2 text-muted"></i>Country
                            </label>
                            @error('country')
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="city" id="city" class="form-control"
                                   placeholder="City" value="{{$profile->city}}" disabled>
                            <label for="city" class="form-label">
                                <i class="fas fa-city me-2 text-muted"></i>City
                            </label>
                            @error('city')
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <textarea name="bio" id="bio" class="form-control"
                                      placeholder="Bio" style="height: 100px" disabled>{{$profile->bio}}</textarea>
                            <label for="bio" class="form-label">
                                <i class="fas fa-info-circle me-2 text-muted"></i>Bio
                            </label>
                            @error('bio')
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <textarea name="address" id="address" class="form-control"
                                      placeholder="Address" style="height: 100px" disabled>{{$profile->address}}</textarea>
                            <label for="address" class="form-label">
                                <i class="fas fa-map-marker-alt me-2 text-muted"></i>Address
                            </label>
                            @error('address')
                            <div class="invalid-feedback d-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4 d-none" id="submit-profile">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                    <button type="button" id="cancel" class="btn btn-outline-danger d-none px-4 ms-2">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <button class="btn btn-outline-danger px-4" onclick="document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@include('profile.modals._add-links')
@include('profile.modals._edit-links')
@include('profile.modals._change-password')


@push('scripts')
<script src="{{asset('js/profile.js')}}"></script>
@endpush
