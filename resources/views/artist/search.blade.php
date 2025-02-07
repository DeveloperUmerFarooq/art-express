@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')

@section('page')

<div class="container mt-3 mb-3">
    <input type="search" placeholder="search artist name/email..." class="form-control" id="search">
</div>
<h1 class="text-center">Artists</h1>
<div class="mx-2 mx-lg-4">
    {{ $dataTable->table() }}
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
