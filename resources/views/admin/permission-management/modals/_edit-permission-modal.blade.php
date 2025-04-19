<div class="modal fade" id="Edit-Permission" tabindex="-1" aria-labelledby="EditPermissionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-success border-bottom">
                <h5 class="modal-title text-light fw-semibold" id="EditPermissionLabel">
                    <i class="fas fa-edit me-2 text-warning"></i> Edit Permission
                </h5>
                <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.management.permission.update') }}" method="POST">
                    @csrf

                    {{-- Hidden Field for Permission ID --}}
                    <input type="hidden" id="permission-id" name="id">

                    {{-- Name Input --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Permission Name</label>
                        <input
                            type="text"
                            id="name"
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

                    {{-- Submit Button --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="fas fa-save me-2"></i> Update Permission
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
