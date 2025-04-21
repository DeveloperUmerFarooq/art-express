<div class="modal fade" id="Login" tabindex="-1" aria-labelledby="Login" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success border-none outline-none d-flex justify-between">
          <h5 class="modal-title fs-3 text-light" id="Label"> <i class="fas fa-sign-in-alt me-2"></i>Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('login') }}" class="d-flex flex-column gap-2" method="POST">
                @csrf
                <div>
                    <label for="email" class="form-label fw-semibold">Email:</label>
                    <input type="email" name="email" class="form-control shadow validate" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="Password" class="form-label fw-semibold">Password:</label>
                    <input type="password" minlength="8" name="password" class="form-control shadow validate" placeholder="Password" value="{{ old('passord') }}" required autocomplete="current-password" autofocus>
                    @error('password')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="d-flex gap-1">
                    <input class="form-check-input shadow" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="form-check-input-label"><small>Remember Me</small></label>
                </div>
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                <center>
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-right-to-bracket me-2"></i> Login
                    </button>
                  </center>
            </form>
        </div>

      </div>
    </div>
  </div>
