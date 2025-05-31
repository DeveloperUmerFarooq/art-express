@extends('layouts.' . $role . 'Layout.layout')
@section('title')
    Portfolio | Art-Express
@endsection
@section('page')
    <div class="container-fluid">
        <div class="d-flex flex-column mt-3">
            <div class="container-fluid d-flex flex-column mt-5">
                <center>
                    <div class="position-relative overflow-hidden"
                        style="width: clamp(10rem,15vw,20rem); height: clamp(10rem,15vw,20rem)">
                        <img loading="lazy" class="rounded-circle w-100 h-100"
                            src="{{ asset('storage/users-avatar/' . $profile->user->avatar) }}" alt="Profile Image"
                            style="object-fit: cover;">
                    </div>
                    <div class="fs-3 mt-1" style="vertical-align: middle">
                        <span><i class="fas fa-user-circle text-primary"></i></span>
                        {{ auth()->user()->name }}
                    </div>
                    <div class="fs-4" style="vertical-align: middle">
                        <span><i class="fas fa-envelope text-secondary"></i></span>
                        {{ auth()->user()->email }}
                    </div>
                    @if ($profile->facebook_link || $profile->instagram_link || $profile->linkedin_link || $profile->twitter_link)
                        <h3 class="mt-1 text-center">Social Links</h3>
                        <div class="d-flex justify-content-center align-items-center">
                            @if ($profile->facebook_link)
                                <a href="{{ $profile->facebook_link }}" target="_blank" rel="noopener noreferrer"
                                    class="mx-2 text-primary">
                                    <i class="fab fa-facebook fa-3x"></i>
                                </a>
                            @endif

                            @if ($profile->instagram_link)
                                <a href="{{ $profile->instagram_link }}" target="_blank" rel="noopener noreferrer"
                                    class="mx-2 text-danger">
                                    <i class="fab fa-instagram fa-3x"></i>
                                </a>
                            @endif

                            @if ($profile->twitter_link)
                                <a href="{{ $profile->twitter_link }}" target="_blank" rel="noopener noreferrer"
                                    class="mx-2 text-info">
                                    <i class="fab fa-twitter fa-3x"></i>
                                </a>
                            @endif

                            @if ($profile->linkedin_link)
                                <a href="{{ $profile->linkedin_link }}" target="_blank" rel="noopener noreferrer"
                                    class="mx-2 text-primary">
                                    <i class="fab fa-linkedin fa-3x"></i>
                                </a>
                            @endif
                        </div>
                    @endif
                </center>
                <nav class="navbar navbar-expand-lg bg-transparent mt-2">
                    <div class="container-fluid">
                        <span class="navbar-brand text-white">Artworks</span>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-bars text-white"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('artist.profile') }}">
                                        <i class="fas fa-eye me-1"></i>View Profile
                                    </a>
                                </li>
                                @can('manage portfolio')
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"
                                            onclick="document.getElementById('imageInput').click();">
                                            <i class="fas fa-plus me-1"></i>Add Images
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                </nav>
                @can('manage portfolio')
                    <form action="{{ route('artist.profile.image') }}" method="POST" class="d-none" id="image-form"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                        <input type="file" name="image" id="imageInput" accept="images/*"
                            onchange="document.getElementById('image-form').submit();">
                    </form>
                @endcan
            </div>
            <div class="container-fluid">
                <div class="portfolio">
                    @foreach ($images as $image)
                        <div class="position-relative" class="img">
                            <img loading="lazy" src="{{ asset($image->image_src) }}" data-bs-toggle="modal"
                                data-bs-target="#imageModal" data-image-url="{{ asset($image->image_src) }}"
                                alt="">
                            @can('manage portfolio')
                            @if ($image->product?->status!=="sold")
                                <a href="#"
                                    onclick="deleteImage('{{ route('artist.profile.image.delete', $image->id) }}')"
                                    class="position-absolute top-0 end-0 mt-2 me-1 btn btn-danger p-1">
                                    <i class="fas fa-trash-alt text-white"></i>
                                </a>
                            @endcan
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- preview modal --}}
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
            <div class="modal-content bg-transparent border-0 shadow-none">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-4 z-3"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body d-flex justify-content-center align-items-center p-0">
                    <img loading="lazy" id="modalImage" src="" alt="Preview" class="img-fluid"
                        style="max-height: 90vh; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalImage = document.getElementById('modalImage');
            const viewImageButtons = document.querySelectorAll('img');

            viewImageButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const imageUrl = this.getAttribute('data-image-url');
                    modalImage.src = imageUrl;
                });
            });
        });

        function deleteImage(url) {
            Swal.fire({
                title: "Delete Selected!",
                text: "Are you sure you want to delete this image?",
                showDenyButton: true,
                icon: 'question',
                confirmButtonText: "Yes",
                confirmButtonColor: "green",
                denyButtonText: `No`,
                customClass: {
                    popup: 'custom-popup'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `${url}`
                } else if (result.isDenied) {
                    toastr.info('Image deletion stopped!')
                }
            });
        }
    </script>
@endpush
