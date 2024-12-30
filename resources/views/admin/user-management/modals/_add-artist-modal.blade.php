<div class="modal fade" id="Add-Artist" tabindex="-1" aria-labelledby="Add-Artist" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-none outline-none d-flex justify-between">
          <h1 class="modal-title fs-3 " id="Label">Add Artist</h1>
          <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.management.artist.add')}}" class="d-flex flex-column gap-2" method="POST" id="Add-Artist">
                @csrf
                <div>
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control bg-transparent shadow validate" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control bg-transparent shadow validate" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="Password" class="form-label">Password:</label>
                    <input type="password" minlength="8" name="password" class="form-control password shadow bg-transparent validate" placeholder="Password" value="{{ old('password') }}" required autocomplete="current-password" autofocus>
                    @error('password')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="Confirm-Password" class="form-label">Confirm Password:</label>
                    <input type="password" id="confirm-password" minlength="8" name="password_confirmation" class="form-control password shadow bg-transparent validate" placeholder="Confirm Password" value="{{ old('password_confirmation') }}" required autocomplete="current-password" autofocus>
                    @error('password')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="d-flex gap-1">
                    <input class="form-check-input shadow" type="checkbox" id="password-show">
                    <label for="password-show"><small> Show Password</small></label>
                </div>
                <center><button class="btn-primary btn">Add Artist</button></center>
            </form>
        </div>
      </div>
    </div>
  </div>
@push('scripts')
<script src="{{asset('assets/js/userCrud.js')}}"></script>
@endpush
