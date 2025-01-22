<div class="modal fade" id="Change-Password" tabindex="-1" aria-labelledby="Change-Password" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-none outline-none d-flex justify-between">
          <h1 class="modal-title fs-3 " id="Label">Change Password</h1>
          <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
        </div>
        <div class="modal-body">
            <form action="{{route(auth()->user()->getRoleNames()->first().'.password.update')}}" class="d-flex flex-column gap-2" method="POST" id="Change-Password">
                @csrf
                <input type="hidden" name="id" value="{{auth()->user()->id}}">
                <div>
                    <label for="current-password" class="form-label">Current Password:</label>
                    <input type="password" minlength="8" name="current_password" class="form-control password shadow validate" placeholder="Current Password" value="{{ old('current-password') }}">
                    @error('current-password')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="form-label">New Password:</label>
                    <input type="password" minlength="8" id="password" name="password" class="form-control password shadow validate" placeholder="New Password" value="{{ old('password') }}">
                    @error('password')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="confirm-password" class="form-label">Confirm Password:</label>
                    <input type="password" minlength="8" id="confirm-password" id="password_confirmation" name="password_confirmation" class="form-control password shadow validate" placeholder="Confirm Password">
                    @error('twitter')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="d-flex align-items-center gap-2">
                    <input class="form-check-input shadow mt-0" type="checkbox" id="password-show">
                    <label for="password-show" class="form-label mb-0" style="font-size: 0.8rem">Show Password</label>
                </div>
                <center><button class="btn-primary btn">Change Password</button></center>
            </form>
        </div>
      </div>
    </div>
  </div>
