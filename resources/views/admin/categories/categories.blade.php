@extends('layouts.adminLayout.layout')

@section('page')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white d-flex align-items-center justify-content-between">
            <h5 class="mb-0">
                <i class="fas fa-folder-tree me-2"></i>Manage Categories
            </h5>
            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#Add-Category">
                <i class="fas fa-plus-circle me-1"></i> Add Category
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table(['class' => 'table table-bordered table-hover table-striped align-middle']) }}
            </div>
        </div>
    </div>
</div>

@include('admin.categories.modals._add-category-modal')
@include('admin.categories.modals._edit-category-modal')
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script src="{{ asset('js/category.js') }}"></script>
@endpush
