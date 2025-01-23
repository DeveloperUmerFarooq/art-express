<div class="modal fade" id="Add-Category" tabindex="-1" aria-labelledby="Add-Category" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-none outline-none d-flex justify-between">
          <h1 class="modal-title fs-3 " id="Label">Add Category</h1>
          <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.management.catergory.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control shadow validate" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                    <div class="row align-items-center mb-3 mt-2">
                        <div class="col-auto">
                            <label for="sub-category-count" class="form-label">Subcategories Count:</label>
                        </div>
                        <div class="col-3 ms-auto">
                            <input type="number" name="count" id="sub-category-count" class="form-control shadow" placeholder="Count" min="0">
                        </div>
                        <div class="col-12">
                            <p class="text-info mt-1"><small>Leave blank if no subcategories are needed.</small></p>
                        </div>
                    </div>

                </div>
                <div id="subcategory">
                    @error('subcategories')
                    <p class="text-danger mx-1">{{$message}}</p>
                    @enderror
                </div>
                <center><button type="submit" class="btn btn-primary">Add Category</button></center>
            </form>
        </div>
      </div>
    </div>
  </div>
