@extends('layouts.' . $role . 'Layout.layout')
@section('page')

<div class="container-fluid">
    <div class="row mt-5">
        <!-- Profile Section -->
        <center>
            <div class="col-12 bg-success p-4 rounded-3 d-flex justify-content-center w-75">
                <div class="d-flex gap-3 align-items-center text-white">
                    <img loading="lazy" src="{{ asset('storage/users-avatar/'.$profile->user->avatar) }}" height="100" width="100" class="rounded-circle" alt="Profile Image">
                    <div>
                        <h1 class="text-start">{{ $profile->user->name }}</h1>
                        <h5>{{ $profile->user->email }}</h5>
                    </div>
                </div>
            </div>
        </center>
        @if ($profile->facebook_link||$profile->instagram_link||$profile->linkedin_link||$profile->twitter_link)
        <h3 class="mt-1 text-center">Social Links</h3>
        <div class="d-flex justify-content-center align-items-center">
            @if($profile->facebook_link)
            <a href="{{$profile->facebook_link}}" target="_blank" rel="noopener noreferrer" class="mx-2 text-primary">
                <i class="fab fa-facebook fa-3x"></i>
            </a>
            @endif

            @if($profile->instagram_link)
            <a href="{{$profile->instagram_link}}" target="_blank" rel="noopener noreferrer" class="mx-2 text-danger">
                <i class="fab fa-instagram fa-3x"></i>
            </a>
            @endif

            @if($profile->twitter_link)
            <a href="{{$profile->twitter_link}}" target="_blank" rel="noopener noreferrer" class="mx-2 text-info">
                <i class="fab fa-twitter fa-3x"></i>
            </a>
            @endif

            @if($profile->linkedin_link)
            <a href="{{$profile->linkedin_link}}" target="_blank" rel="noopener noreferrer" class="mx-2 text-primary">
                <i class="fab fa-linkedin fa-3x"></i>
            </a>
            @endif
        </div>
        @endif
        <nav>
            <nav class="navbar navbar-expand-lg bg-transparent mt-2">
                <div class="container-fluid">
                  <span class="navbar-brand text-white">Artworks</span>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars text-white"></i>
                  </button>
                  @if (auth()->user()->hasRole('admin'))
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('admin.profile.details.view',$profile->user->id)}}">
                            <i class="fas fa-eye me-1"></i>View Profile
                          </a>
                        </li>
                    </ul>
                </div>
                @endif
                </div>
              </nav>
        </nav>
        <div class="container-fluid">
            <div class="portfolio">
                @foreach ($images as $image)
                <div class="position-relative" class="img">
                    <img loading="lazy" src="{{asset($image->image_src)}}" data-bs-toggle="modal" data-bs-target="#imageModal" data-image-url="{{asset($image->image_src)}}" alt="">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- preview modal --}}
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">
                    <i class="fas fa-image me-2"></i>Image Preview
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img loading="lazy" id="modalImage" src="" alt="Preview" class="img-fluid" style="height: 25rem; object-fit:contain">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Close
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalImage = document.getElementById('modalImage');
        const viewImageButtons = document.querySelectorAll('img');

        viewImageButtons.forEach(button => {
            button.addEventListener('click', function () {
                const imageUrl = this.getAttribute('data-image-url');
                modalImage.src = imageUrl;
            });
        });
    });
    </script>
@endpush
