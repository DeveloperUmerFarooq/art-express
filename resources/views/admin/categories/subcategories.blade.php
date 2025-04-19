@extends('layouts.adminLayout.layout')

@section('page')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white d-flex align-items-center justify-content-between">
            <h5 class="mb-0">
                <i class="fas fa-sitemap me-2"></i>Manage SubCategories
            </h5>
            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#Add-SubCategory">
                <i class="fas fa-plus-circle me-1"></i> Add SubCategory
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table(['class' => 'table table-bordered table-hover table-striped align-middle']) }}
            </div>
        </div>
    </div>
</div>

<!-- Edit SubCategory Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title text-light" id="exampleModalLabel">
                    <i class="fas fa-edit me-2 text-warning"></i>Edit SubCategory
                </h5>
                <button type="button" class="btn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('admin.management.catergory.sub.update') }}" method="POST">
                    @csrf
                    <input type="hidden" id="sub-category-id" name="id">

                    <div class="mb-3">
                        <label for="Name" class="form-label fw-semibold">Name:</label>
                        <input type="text" id="Name" name="Name" class="form-control shadow-sm" placeholder="Enter SubCategory Name" value="{{ old('name') }}" required>
                        @error('Name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-warning text-light">
                            <i class="fas fa-save me-1"></i> Update SubCategory
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.categories.modals._add-subcategory-modal')
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script src="{{ asset('js/category.js') }}"></script>
@endpush
