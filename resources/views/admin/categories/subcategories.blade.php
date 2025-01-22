@extends('layouts.adminLayout.layout')
@section('page')
<div class="container mt-5">
    <div class="d-flex flex-column border border-1 border-dark-subtle p-3 rounded-2">
        <div class="d-flex align-items-center">
            <h5 class="mt-2">Manage SubCategories</h5>
            <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#Add-SubCategory">Add SubCategory</button>
        </div>
        <hr>
        <div class="table-responsive overflow-hidden">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>

  <!--Edit Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit SubCategory</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('admin.management.catergory.sub.update')}}" method="POST">
            @csrf
            <input type="hidden" id="sub-category-id" name="id">
            <label for="Name">Name:</label>
            <input type="text" id="Name" name="Name" class="form-control shadow validate" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('Name')
                <p class="ms-1 text-danger">{{$message}}</p>
            @enderror
            <center>
                <button type="submit" class="btn btn-primary mt-3">Update SubCategory</button>
            </center>
          </form>
        </div>
      </div>
    </div>
  </div>
@include('admin.categories.modals._add-subcategory-modal')
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
    <script src="{{asset('assets/js/category.js')}}"></script>
@endpush
