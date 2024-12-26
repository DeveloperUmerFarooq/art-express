@extends('layouts.adminLayout.layout')
@section('page')
<div class="container mt-5">
    <div class="d-flex flex-column border border-1 border-dark-subtle p-3 rounded-2">
        <div class="d-flex align-items-center">
            <h5 class="mt-2">Manage Users</h5>
            <a href="" class="ms-auto">
                <button class="btn btn-primary ">Add User</button>
            </a>
        </div>
        <hr>
        <div class="card-body table-responsive overflow-hidden" style="height: max-content !important">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
