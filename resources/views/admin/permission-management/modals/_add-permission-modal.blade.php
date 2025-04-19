<div class="modal fade" id="Add-Permission" tabindex="-1" aria-labelledby="AddPermissionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-success border-bottom">
                <h5 class="modal-title fw-semibold text-light" id="AddPermissionLabel">
                    <i class="fas fa-shield-alt me-2 text-primary"></i> Add Permission
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.management.permission.store') }}" method="POST">
                    @csrf

                    {{-- Permission Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Permission Name</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control validate @error('name') is-invalid @enderror"
                            placeholder="Enter permission name"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            autofocus
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Assign Permission to Roles --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Assign Permission to Roles</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    id="admin"
                                    name="roles[]"
                                    value="admin"
                                    class="form-check-input"
                                >
                                <label for="admin" class="form-check-label">Admin</label>
                            </div>
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    id="artist"
                                    name="roles[]"
                                    value="artist"
                                    class="form-check-input"
                                >
                                <label for="artist" class="form-check-label">Artist</label>
                            </div>
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    id="user"
                                    name="roles[]"
                                    value="user"
                                    class="form-check-input"
                                >
                                <label for="user" class="form-check-label">User</label>
                            </div>
                        </div>
                        @error('roles')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-plus-circle me-2"></i> Add Permission
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
