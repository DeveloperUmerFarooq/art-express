<div class="modal fade" id="Sign-Up" tabindex="-1" aria-labelledby="Sign-Up" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content shadow-lg rounded-3">
      <div class="modal-header bg-success border-0">
        <h1 class="modal-title fs-4 fw-semibold text-light" id="Label">
          <i class="fas fa-user-plus me-2"></i> Register
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="{{ route('register') }}" id="register" method="POST" class="d-flex flex-column gap-3">
          @csrf

          <div>
            <label for="name" class="form-label fw-semibold">Name:
            </label>
            <input type="text" name="name" class="form-control shadow-sm validate" placeholder="Enter your name"
              value="{{ old('name') }}" required min="3" max="30" autocomplete="email" autofocus>
            @error('name')
            <p class="text-danger small mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="email" class="form-label fw-semibold">Email:
            </label>
            <input type="email" name="reg_email" class="form-control shadow-sm validate" placeholder="Enter your email"
              value="{{ old('reg_email') }}" required autocomplete="email" autofocus>
            @error('reg_email')
            <p class="text-danger small mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="Password" class="form-label fw-semibold">Password:
            </label>
            <input type="password" minlength="8" name="password" id="password-field"
              class="form-control shadow-sm validate" placeholder="Enter password" value="{{ old('password') }}" required
              autocomplete="current-password" autofocus>
            @error('password')
            <p class="text-danger small mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="Confirm-Password" class="form-label fw-semibold">Confirm Password:
            </label>
            <input type="password" id="confirm-password-field" minlength="8" name="password_confirmation"
              class="form-control shadow-sm validate" placeholder="Confirm password"
              value="{{ old('password_confirmation') }}" required autocomplete="current-password" autofocus>
            @error('password')
            <p class="text-danger small mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="password-show">
            <label class="form-check-label small" for="password-show">Show Password
            </label>
          </div>

          <div class="mt-2">
            <label class="form-label fw-semibold d-block">
              <i class="fas fa-user-tag me-1 text-secondary"></i> Choose Role:
            </label>
            <div class="d-flex gap-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="role_admin" value="artist" required>
                <label class="form-check-label" for="role_admin">Artist</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="role_user" value="user" required>
                <label class="form-check-label" for="role_user">User</label>
              </div>
            </div>
          </div>

          <p class="small">By clicking on Register, you agree to our <a href="{{route('terms')}}" class="text-decoration-underline">terms and conditions</a>.
          </p>

          <div class="text-center">
            <button type="submit" class="btn btn-primary px-4 py-2">
              <i class="fas fa-user-check me-2"></i> Register
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordShowCheckbox = document.getElementById('password-show');
        const passwordField = document.getElementById('password-field');
        const confirmPasswordField = document.getElementById('confirm-password-field');

        passwordShowCheckbox.addEventListener('change', function() {
            if (this.checked) {
                passwordField.type = 'text';
                confirmPasswordField.type = 'text';
            } else {
                passwordField.type = 'password';
                confirmPasswordField.type = 'password';
            }
        });
    });
</script>
@endpush
