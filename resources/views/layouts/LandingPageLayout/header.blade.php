<nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand fs-3" href="#">Art-Express</a>
      <button class="navbar-toggler border-none outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff0cd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-justify"><path d="M3 12h18"/><path d="M3 18h18"/><path d="M3 6h18"/></svg>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto gap-1 gap-md-4">
            @if (auth()->user())
            <li class="nav-item text-center">
                <a class="nav-link fs-6" href="{{ route(auth()->user()->getRoleNames()->first().'.dashboard') }}">Dashboard</a>
              </li>
            @else
            <li class="nav-item text-center">
              <a class="nav-link fs-6" href="#" data-bs-toggle="modal" data-bs-target="#Login">Login</a>
            </li>
            <li class="nav-item text-center">
              <a class="nav-link fs-6" href="#" data-bs-toggle="modal" data-bs-target="#Sign-Up">Sign up</a>
            </li>
            @endif

        </ul>
      </div>
    </div>
  </nav>

{{-- Login Modal --}}

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
                    <input type="email" name="email" class="form-control bg-transparent shadow validate" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="Password" class="form-label">Password:</label>
                    <input type="password" minlength="6" name="password" class="form-control shadow bg-transparent validate" placeholder="Password" value="{{ old('passord') }}" required autocomplete="current-password" autofocus>
                    @error('password')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="d-flex gap-1">
                    <input class="form-check bg-transparent shadow" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="form-check-label"><small>Remember Me</small></label>
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

  {{-- Sign Up modal --}}

  <div class="modal fade" id="Sign-Up" tabindex="-1" aria-labelledby="Sign-Up" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-none outline-none d-flex justify-between">
          <h1 class="modal-title fs-3 " id="Label">Sign Up</h1>
          <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('register') }}" class="d-flex flex-column gap-2" method="POST">
                @csrf
                <div>
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control bg-transparent shadow validate" placeholder="Name" value="{{ old('name') }}" required autocomplete="email" autofocus>
                    @error('name')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control bg-transparent shadow validate" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="Password" class="form-label">Password:</label>
                    <input type="password" id="password" minlength="6" name="password" class="form-control shadow bg-transparent validate" placeholder="Password" value="{{ old('password') }}" required autocomplete="current-password" autofocus>
                    @error('password')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="Confirm-Password" class="form-label">Confirm Password:</label>
                    <input type="password" id="confirm-password" minlength="6" name="password_confirmation" class="form-control shadow bg-transparent validate" placeholder="Confirm Password" value="{{ old('password_confirmation') }}" required autocomplete="current-password" autofocus>
                    @error('password')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <label for="role">Choose Role:</label>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="role_admin" value="artist" required>
                            <label class="form-check-label" for="role_admin">
                                {{ __('Artist') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="role_user" value="user" required>
                            <label class="form-check-label" for="role_user">
                                {{ __('User') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-1">
                    <input class="form-check bg-transparent shadow" type="checkbox" id="password-show">
                    <label for="password-show"><small> Show Password</small></label>
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


  @push('scripts')
        <script>
            const pass=document.getElementById('password');
            const confirmPass= document.getElementById('confirm-password');
            const toggle=document.getElementById('password-show')
            console.log(toggle);
            toggle.addEventListener('change',()=>{
                pass.type=toggle.checked?'text':'password'
                confirmPass.type=toggle.checked?'text':'password'
            })
        </script>
        @endpush

