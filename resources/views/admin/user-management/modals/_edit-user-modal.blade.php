<div class="modal fade" id="Edit-Form" tabindex="-1" aria-labelledby="Edit-Form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-success px-4 py-3 rounded-top">
                <h5 class="modal-title fs-4 fw-bold text-light" id="Label">
                    <i class="fas fa-user-edit me-2 text-warning"></i> Edit User
                </h5>
                <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times fa-lg text-dark"></i>
                </button>
            </div>

            <div class="modal-body px-4 py-4">
                <form action="{{ route('admin.management.user.edit') }}"
                      class="d-flex flex-column gap-3"
                      method="POST" id="Edit-Form" enctype="multipart/form-data">
                    @csrf

                    <div class="container">
                        <div class="d-flex flex-column align-items-center justify-content-center gap-2">
                            <div class="rounded shadow bg-dark overflow-hidden" style="width: 120px; height: 120px;">
                                <img loading="lazy" id="img" width="100%" height="100%" style="object-fit: cover;" alt="">
                            </div>
                            <input class="form-control form-control-sm" type="file" name="image" id="image"
                                   value="{{ old('image') }}" onchange="preview(event)">
                        </div>
                    </div>

                    <input type="hidden" name="id" id="id">

                    <div>
                        <label for="name" class="form-label fw-semibold">
                            <i class="fas fa-user me-1 text-primary"></i> Name:
                        </label>
                        <input type="text" id="Name" name="name"
                               class="form-control shadow-sm validate"
                               placeholder="Full Name" value="{{ old('name') }}" autocomplete="name" autofocus>
                        @error('name')
                        <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="form-label fw-semibold">
                            <i class="fas fa-envelope me-1 text-primary"></i> Email:
                        </label>
                        <input type="email" id="Email" name="email"
                               class="form-control shadow-sm validate"
                               placeholder="Email Address" value="{{ old('email') }}" autocomplete="email">
                        @error('email')
                        <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="form-label fw-semibold">
                            <i class="fas fa-lock me-1 text-primary"></i> Password:
                        </label>
                        <input type="password" id="password" name="password" minlength="8"
                               class="form-control shadow-sm validate password"
                               placeholder="New Password" value="{{ old('password') }}" autocomplete="current-password">
                        @error('password')
                        <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-check d-flex align-items-center gap-2">
                        <input class="form-check-input shadow-sm" type="checkbox" id="show-password">
                        <label for="password-show" class="form-check-label">
                            <small><i class="fas fa-eye me-1"></i> Show Password</small>
                        </label>
                    </div>

                    <div class="d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-warning px-4 py-2">
                            <i class="fas fa-save me-2"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/userCrud.js') }}"></script>
@endpush
