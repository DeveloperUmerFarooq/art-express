<div class="modal fade" id="Add-User" tabindex="-1" aria-labelledby="Add-User" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-success border-none outline-none d-flex justify-between">
            <h5 class="modal-title text-light fw-semibold" id="Label">
                <i class="fas fa-user-plus me-2 text-primary"></i> Add User
            </h5>
            <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.management.user.add')}}" class="d-flex flex-column gap-2" method="POST" id="Add-User">
                @csrf
                <div>
                    <label for="name" class="form-label fw-semibold">Name:</label>
                    <input type="text" id="name" name="name" class="form-control shadow validate" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="form-label fw-semibold">Email:</label>
                    <input type="email" id="email" name="email" class="form-control shadow validate" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="Password" class="form-label fw-semibold">Password:</label>
                    <input type="password" minlength="8" name="password" class="form-control password shadow validate" placeholder="Password" value="{{ old('password') }}" required autocomplete="current-password" autofocus>
                    @error('password')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="Confirm-Password" class="form-label fw-semibold">Confirm Password:</label>
                    <input type="password" id="confirm-password" minlength="8" name="password_confirmation" class="password form-control shadow validate" placeholder="Confirm Password" value="{{ old('password_confirmation') }}" required autocomplete="current-password" autofocus>
                    @error('password')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="d-flex gap-1">
                    <input class="form-check-input shadow" type="checkbox" id="password-show">
                    <label for="password-show"><small> Show Password</small></label>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="fas fa-user-plus me-2"></i> Add User
                    </button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@push('scripts')
<script src="{{asset('js/userCrud.js')}}"></script>
@endpush
