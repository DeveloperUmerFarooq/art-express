<div class="modal fade" id="Add-Social-Links" tabindex="-1" aria-labelledby="Add-Social-Links" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content shadow-lg rounded-4">
        <div class="modal-header bg-success border-0">
          <h5 class="modal-title fs-4 d-flex align-items-center text-light gap-2" id="Label">
            <i class="fas fa-link text-primary"></i> Add Social Links
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body px-4 pb-4">
          <form action="{{route($role.'.profile.links')}}" class="d-flex flex-column gap-3" method="POST" id="Add-Social-Links">
            @csrf
            <input type="hidden" name="id" value="{{auth()->user()->id}}">

            <div class="form-group">
              <label for="facebook" class="form-label">Facebook</label>
              <input type="url" name="facebook" class="form-control shadow-sm validate" placeholder="Enter Facebook link" value="{{ old('facebook') }}">
              @error('facebook')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="form-group">
              <label for="instagram" class="form-label">Instagram</label>
              <input type="url" name="instagram" class="form-control shadow-sm validate" placeholder="Enter Instagram link" value="{{ old('instagram') }}">
              @error('instagram')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="form-group">
              <label for="twitter" class="form-label">Twitter</label>
              <input type="url" name="twitter" class="form-control shadow-sm validate" placeholder="Enter Twitter link" value="{{ old('twitter') }}">
              @error('twitter')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="form-group">
              <label for="linkedin" class="form-label">LinkedIn</label>
              <input type="url" name="linkedin" class="form-control shadow-sm validate" placeholder="Enter LinkedIn link" value="{{ old('linkedin') }}">
              @error('linkedin')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="text-center mt-3">
              <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save me-2"></i> Add Links
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
