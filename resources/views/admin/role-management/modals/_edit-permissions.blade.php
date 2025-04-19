<div class="modal fade" id="Edit-Permission-Role" tabindex="-1" aria-labelledby="EditPermissionRoleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-success border-bottom">
                <h5 class="modal-title text-light fw-semibold" id="EditPermissionRoleLabel">
                    <i class="fas fa-cogs me-2 text-warning"></i> Edit Permissions to Role
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.management.role.update') }}" method="POST">
                    @csrf
                    <input type="hidden" id="role-id" name="id">

                    {{-- Permissions Section --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select Permissions to Assign:</label>
                        @if ($errors->any())
                            <p class="text-danger ms-1">Please check at least one permission</p>
                        @endif
                        <div class="row align-items-center justify-content-center">
                            @foreach ($permissions as $permission)
                                <div class="col-6 col-md-4 mb-2">
                                    <div class="form-check">
                                        <input type="checkbox"
                                               id="permission-{{$permission->id}}"
                                               name="permissions[]"
                                               value="{{$permission->name}}"
                                               class="form-check-input">
                                        <label for="permission-{{$permission->id}}" class="form-check-label">
                                            <small>{{$permission->name}}</small>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('permissions')
                            <p class="text-danger ms-1">{{$message}}</p>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="fas fa-save me-2"></i> Update Permissions
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
