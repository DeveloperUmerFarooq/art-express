<div class="modal fade" id="Add-Social-Links" tabindex="-1" aria-labelledby="Add-Social-Links" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-none outline-none d-flex justify-between">
          <h1 class="modal-title fs-3 " id="Label">Add Social Links</h1>
          <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
        </div>
        <div class="modal-body">
            <form action="{{route(auth()->user()->getRoleNames()->first().'.profile.links')}}" class="d-flex flex-column gap-2" method="POST" id="Add-Social-Links">
                @csrf
                <input type="hidden" name="id" value="{{auth()->user()->id}}">
                <div>
                    <label for="facebook" class="form-label">Facebook:</label>
                    <input type="url" name="facebook" class="form-control shadow validate" placeholder="Facebook Link" value="{{ old('facebook') }}">
                    @error('facebook')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="instagram" class="form-label">Instagram:</label>
                    <input type="url" name="instagram" class="form-control shadow validate" placeholder="Instagram Link" value="{{ old('instagram') }}">
                    @error('instagram')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="twitter" class="form-label">Twitter:</label>
                    <input type="url" name="twitter" class="form-control shadow validate" placeholder="Twitter Link" value="{{ old('twitter') }}">
                    @error('twitter')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="linkedin" class="form-label">Linked In:</label>
                    <input type="url" name="linkedin" class="form-control shadow validate" placeholder="Linked In Link" value="{{ old('linkedin') }}">
                    @error('linkedin')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <center><button class="btn-primary btn">Add Links</button></center>
            </form>
        </div>
      </div>
    </div>
  </div>
