<div class="modal fade" id="Edit-Permission-Role" tabindex="-1" aria-labelledby="Edit-Permission-Role" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-none outline-none d-flex justify-between">
          <h1 class="modal-title fs-3 " id="Label">Edit Permissions</h1>
          <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.management.role.update') }}" method="POST">
                @csrf
                <input type="hidden" id="role-id" name="id">
                <div class="mb-3">
                    <label class="form-label">Edit Permission to Role:</label>
                    @if ($errors->any())
                        <p class="text-danger ms-1">Please check at least one permission</p>
                    @endif
                    <div class="row align-items-center justify-content-center">
                        @foreach ($permissions as $permission)
                        <label for="{{$permission->id}}" class="col-6 col-md-4">
                            <input type="checkbox" id="{{$permission->id}}" name="permissions[]" value="{{$permission->name}}" class="form-check-input permission-check">
                        <small>{{$permission->name}}</small></label>
                        @endforeach
                    </div>
                    @error('roles')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <center><button type="submit" class="btn btn-primary">Edit Permissions</button></center>
            </form>
        </div>
      </div>
    </div>
  </div>
