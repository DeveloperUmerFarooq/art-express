@extends('layouts.' . $role . 'Layout.layout')

@section('page')

<div class="container mt-5 mb-4">

    <!-- Heading Section -->
    <h1 class="text-center mb-5">Artists</h1>

    <!-- Search Bar Section -->
    <div class="d-flex justify-content-center mb-4">
        <input type="search" placeholder="Search artist name/email..." class="form-control w-50" id="search">
    </div>

    <!-- DataTable Section -->
    <div class="mx-2 mx-lg-4">
        {{ $dataTable->table(['class' => 'table table-striped table-hover bg-white my-3 table-bordered shadow-sm']) }}
    </div>
</div>

@endsection

@push('scripts')
{{ $dataTable->scripts() }}
<script>
document.getElementById('search').addEventListener('keyup',function(){
    window.LaravelDataTables['searchartist-table'].search(this.value).draw();
})
</script>
@endpush
