<div class="modal fade" id="Edit-Social-Links" tabindex="-1" aria-labelledby="Edit-Social-Links" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-none outline-none d-flex justify-between">
          <h1 class="modal-title fs-3 " id="Label">Edit Social Links</h1>
          <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.profile.links.update')}}" class="d-flex flex-column gap-2" method="POST" id="Edit-Social-Links">
                @csrf
                <input type="hidden" name="id" value="{{auth()->user()->id}}">
                <div>
                    <label for="facebook" class="form-label">Facebook:</label>
                    <input type="url" id="facebook" name="facebook" class="form-control shadow validate" placeholder="Facebook Link" value="{{ old('facebook',$profile->facebook_link) }}">
                    @error('facebook')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                    <label for="clearFacebook" class="mt-1" style="font-size: 0.8rem">
                        <input id="clearFacebook" class="form-check-input mark-null" data-target="#facebook" type="checkbox" /><span class="ms-1 text-dark-emphasis"><small>Remove Link</small></span>
                    </label>
                </div>
                <div>
                    <label for="instagram" class="form-label">Instagram:</label>
                    <input type="url" id="instagram" name="instagram" class="form-control shadow validate" placeholder="Instagram Link" value="{{ old('instagram',$profile->instagaram_link) }}">
                    @error('instagram')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                    <label for="clearInstagram" class="mt-1" style="font-size: 0.8rem">
                        <input id="clearInstagram" class="form-check-input mark-null" data-target="#instagram" type="checkbox" /><span class="ms-1 text-dark-emphasis"><small>Remove Link</small></span>
                    </label>
                </div>
                <div>
                    <label for="twitter" class="form-label">Twitter:</label>
                    <input type="url" id="twitter" id="twitter" name="twitter" class="form-control shadow validate" placeholder="Twitter Link" value="{{ old('twitter',$profile->twitter_link) }}">
                    @error('twitter')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                    <label for="clearTwitter" class="mt-1" style="font-size: 0.8rem">
                        <input id="clearTwitter" class="form-check-input mark-null" data-target="#twitter" type="checkbox" /><span class="ms-1 text-dark-emphasis"><small>Remove Link</small></span>
                    </label>
                </div>
                <div>
                    <label for="linkedin" class="form-label">Linked In:</label>
                    <input type="url" id="linkedin" name="linkedin" class="form-control shadow validate" placeholder="Linked In Link" value="{{ old('linkedin',$profile->linkedin_link) }}">
                    @error('linkedin')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                    <label for="clearLinkedin" class="mt-1" style="font-size: 0.8rem">
                        <input id="clearLinkedin" class="form-check-input mark-null" data-target="#linkedin" type="checkbox" /><span class="ms-1 text-dark-emphasis"><small>Remove Link</small></span>
                    </label>
                </div>
                <center><button class="btn-primary btn">Update</button></center>
            </form>
        </div>
      </div>
    </div>
  </div>
