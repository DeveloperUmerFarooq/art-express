@extends('layouts.adminLayout.layout')
@section('page')
<div class="container mt-5">
    <div class="d-flex flex-column border border-1 border-dark-subtle p-3 rounded-2">
        <div class="d-flex align-items-center">
            <h5 class="mt-2">Manage Permissions</h5>
            <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#Add-Permission">Add Permission</button>
        </div>
        <hr>
        <div class="table-responsive overflow-hidden">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@include('admin.permission-management.modals._add-permission-modal')
@include('admin.permission-management.modals._edit-permission-modal')
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
    <script src="{{asset('assets/js/permission.js')}}"></script>
@endpush
