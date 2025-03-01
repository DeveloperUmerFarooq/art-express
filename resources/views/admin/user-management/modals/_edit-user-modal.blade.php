<div class="modal fade" id="Edit-Form" tabindex="-1" aria-labelledby="Edit-Form" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-none outline-none d-flex justify-between">
          <h1 class="modal-title fs-3 " id="Label">Edit  User</h1>
          <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.management.user.edit')}}" class="d-flex flex-column gap-2" method="POST" id="Edit-Form" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="d-flex flex-column align-items-center justify-content-center gap-2">
                        <div class="rounded shadow bg-dark w-25 h-25">
                            <img id="img" width="100%" style="height: 7rem" alt="">
                        </div>
                        <div>
                            <input class="form-control" type="file" name="image" id="image" value="{{old('image')}}" onchange="preview(event)">
                        </div>
                    </div>
                </div>
                <div>
                    <input type="hidden" name="id" id="id">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="Name" name="name" class="form-control shadow validate" placeholder="Name" value="{{ old('name') }}" '' autocomplete="name" autofocus>
                    @error('name')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="Email" name="email" class="form-control shadow validate" placeholder="Email" value="{{ old('email') }}" '' autocomplete="email" autofocus>
                    @error('email')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" minlength="8" name="password" class="form-control password shadow validate" placeholder="Password" value="{{ old('password') }}" autocomplete="current-password">
                    @error('password')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="d-flex gap-1">
                    <input class="form-check-input shadow" type="checkbox" id="show-password">
                    <label for="password-show"><small> Show Password</small></label>
                </div>
                <center><button class="btn-primary btn">Submit</button></center>
            </form>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
  <script src="{{asset('assets/js/userCrud.js')}}"></script>
  @endpush
