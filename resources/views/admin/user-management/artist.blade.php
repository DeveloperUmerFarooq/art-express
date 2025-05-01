@extends('layouts.adminLayout.layout')

@section('page')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white d-flex align-items-center justify-content-between">
            <h5 class="mb-0">
                <i class="fas fa-palette me-2 text-light"></i> Manage Artists
            </h5>
            <button class="btn btn-light btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#Add-Artist">
                <i class="fas fa-user-plus me-1"></i> Add Artist
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                {{ $dataTable->table(['class' => 'table table-striped table-hover align-middle']) }}
            </div>
        </div>
    </div>
</div>

@include('admin.user-management.modals._add-artist-modal')
@include('admin.user-management.modals._edit-user-modal')
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
