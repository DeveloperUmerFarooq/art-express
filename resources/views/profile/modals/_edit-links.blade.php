<!-- Edit Social Links Modal -->
<div class="modal fade" id="Edit-Social-Links" tabindex="-1" aria-labelledby="EditSocialLinksLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-0 shadow-lg rounded-3">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="EditSocialLinksLabel">
            <i class="fas fa-edit me-2"></i>Edit Social Links
          </h5>
          <button type="button" class="btn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route($role.'.profile.links.update') }}" method="POST" id="Edit-Social-Links">
          @csrf
          <input type="hidden" name="id" value="{{ auth()->user()->id }}">
          <div class="modal-body p-4">
            <!-- Facebook -->
            <div class="mb-3">
              <label for="facebook" class="form-label">
                <i class="fab fa-facebook-square me-1 text-primary"></i>Facebook
              </label>
              <input type="url" id="facebook" name="facebook" class="form-control shadow-sm" placeholder="Enter Facebook URL" value="{{ $profile->facebook_link }}">
              @error('facebook')
                <small class="text-danger">{{ $message }}</small>
              @enderror
              <div class="form-check mt-1">
                <input class="form-check-input mark-null" type="checkbox" id="clearFacebook" data-target="#facebook">
                <label class="form-check-label small text-muted" for="clearFacebook">Remove Link</label>
              </div>
            </div>

            <!-- Instagram -->
            <div class="mb-3">
              <label for="instagram" class="form-label">
                <i class="fab fa-instagram me-1 text-danger"></i>Instagram
              </label>
              <input type="url" id="instagram" name="instagram" class="form-control shadow-sm" placeholder="Enter Instagram URL" value="{{ $profile->instagram_link }}">
              @error('instagram')
                <small class="text-danger">{{ $message }}</small>
              @enderror
              <div class="form-check mt-1">
                <input class="form-check-input mark-null" type="checkbox" id="clearInstagram" data-target="#instagram">
                <label class="form-check-label small text-muted" for="clearInstagram">Remove Link</label>
              </div>
            </div>

            <!-- Twitter -->
            <div class="mb-3">
              <label for="twitter" class="form-label">
                <i class="fab fa-twitter me-1 text-info"></i>Twitter
              </label>
              <input type="url" id="twitter" name="twitter" class="form-control shadow-sm" placeholder="Enter Twitter URL" value="{{ $profile->twitter_link }}">
              @error('twitter')
                <small class="text-danger">{{ $message }}</small>
              @enderror
              <div class="form-check mt-1">
                <input class="form-check-input mark-null" type="checkbox" id="clearTwitter" data-target="#twitter">
                <label class="form-check-label small text-muted" for="clearTwitter">Remove Link</label>
              </div>
            </div>

            <!-- LinkedIn -->
            <div class="mb-3">
              <label for="linkedin" class="form-label">
                <i class="fab fa-linkedin me-1 text-primary"></i>LinkedIn
              </label>
              <input type="url" id="linkedin" name="linkedin" class="form-control shadow-sm" placeholder="Enter LinkedIn URL" value="{{ $profile->linkedin_link }}">
              @error('linkedin')
                <small class="text-danger">{{ $message }}</small>
              @enderror
              <div class="form-check mt-1">
                <input class="form-check-input mark-null" type="checkbox" id="clearLinkedin" data-target="#linkedin">
                <label class="form-check-label small text-muted" for="clearLinkedin">Remove Link</label>
              </div>
            </div>
          </div>

          <div class="modal-footer justify-content-center">
            <button type="submit" class="btn btn-success px-4">
              <i class="fas fa-save me-2"></i>Update Links
            </button>
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
              <i class="fas fa-times me-2"></i>Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
