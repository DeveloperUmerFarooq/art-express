<div class="modal fade" id="Login" tabindex="-1" aria-labelledby="Login" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-none outline-none d-flex justify-between">
          <h1 class="modal-title fs-3" id="Label">Login</h1>
          <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('login') }}" class="d-flex flex-column gap-2" method="POST">
                @csrf
                <div>
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control shadow validate" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="Password" class="form-label">Password:</label>
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
                <center><button type="submit" class="btn-primary btn">Login</button></center>
            </form>
        </div>

      </div>
    </div>
  </div>
