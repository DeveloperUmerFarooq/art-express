<div class="modal fade" id="Add-Permission" tabindex="-1" aria-labelledby="Add-Permission" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-none outline-none d-flex justify-between">
          <h1 class="modal-title fs-3 " id="Label">Add Permission</h1>
          <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.management.permission.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control shadow validate" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Add Permission to Roles:</label>
                    <div class="d-flex align-items-center justify-content-center gap-3">
                        <label for="admin">
                            <input type="checkbox" id="admin" name="roles[]" value="admin" class="form-check-input">
                        <small>Admin</small></label>
                        <label for="artist">
                            <input type="checkbox" id="artist" value="artist" name="roles[]" class="form-check-input">
                        <small>Artist</small></label>
                        <label for="user">
                            <input type="checkbox" id="user" value="user" name="roles[]" class="form-check-input">
                        <small>User</small></label>
                    </div>
                    @error('roles')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <center><button type="submit" class="btn btn-primary">Add Permission</button></center>
            </form>
        </div>
      </div>
    </div>
  </div>
