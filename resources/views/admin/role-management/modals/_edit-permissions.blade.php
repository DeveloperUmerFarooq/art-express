<div class="modal fade" id="Edit-Permission-Role" tabindex="-1" aria-labelledby="Edit-Permission-Role" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success border-0">
          <h5 class="modal-title fs-4 d-flex text-light align-items-center gap-2" id="Label">
            <i class="fas fa-user-shield text-warning"></i> Edit Permissions
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.management.role.update') }}" method="POST">
            @csrf
            <input type="hidden" id="role-id" name="id">

            <div class="mb-3">
              <label class="form-label fw-semibold">Edit Permissions for Role:</label>
              @if ($errors->any())
                <p class="text-danger ms-1">Please check at least one permission</p>
              @endif

              <div class="row">
                @foreach ($permissions as $permission)
                <div class="col-6 col-md-4">
                  <div class="form-check">
                    <input type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}" class="form-check-input permission-check">
                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                      {{ ucfirst($permission->name) }}
                    </label>
                  </div>
                </div>
                @endforeach
              </div>
              @error('roles')
              <p class="text-danger mx-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="text-center mt-3">
              <button type="submit" class="btn btn-warning">
                <i class="fas fa-save me-2"></i> Save Changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
