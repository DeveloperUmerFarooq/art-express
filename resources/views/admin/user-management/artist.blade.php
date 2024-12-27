@extends('layouts.adminLayout.layout')
@section('page')
<div class="container mt-5">
    <div class="d-flex flex-column border border-1 border-dark-subtle p-3 rounded-2">
        <div class="d-flex align-items-center">
            <h5 class="mt-2">Manage Artists</h5>
            <button class="btn btn-primary ms-auto"  data-bs-toggle="modal" data-bs-target="#Add-Artist">Add Artist</button>
        </div>
        <hr>
        <div class="table-responsive">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@include('admin.user-management.modals._add-artist-modal')
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
