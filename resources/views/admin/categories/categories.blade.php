@extends('layouts.adminLayout.layout')
@section('page')
<div class="container mt-5">
    <div class="d-flex flex-column border border-1 border-dark-subtle p-3 rounded-2">
        <div class="d-flex align-items-center">
            <h5 class="mt-2">Manage Categories</h5>
            <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#Add-Category">Add Category</button>
        </div>
        <hr>
        <div class="table-responsive overflow-hidden">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@include('admin.categories.modals._add-category-modal')
@include('admin.categories.modals._edit-category-modal')
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
    <script src="{{asset('assets/js/category.js')}}"></script>
@endpush
