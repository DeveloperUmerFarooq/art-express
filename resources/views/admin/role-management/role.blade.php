@extends('layouts.adminLayout.layout')
@section('title')
Role-Management
@endsection

@section('page')
<div class="container mt-5">
    <div class="row">
        @foreach ($roles as $role)
            <div class="col-md-4 mb-4">
                <div class="card" style="height:max-content">
                    <div class="card-header text-center" style="background-color: var(--secondary);color:var(--primary)">
                        <h3>Role: {{ $role->name }}</h3>
                    </div>
                    <div class="card-body">
                        <h6>Permissions:</h6>
                        <ul class="list-group">
                            @foreach ($role->permissions as $permission)
                                <li class="list-group-item bg-transparent">{{ $permission->name }}</li>
                            @endforeach
                        </ul>
                        <center>
                            <button class="btn btn-primary mt-md-3 mt-2" data-bs-toggle="modal" data-bs-target="#Edit-Permission-Role" onclick="CheckPermissions({{$role->permissions}},{{$role->id}})"> Edit Permissions</button>
                        </center>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@include('admin.role-management.modals._edit-permissions')
@endsection
@push('scripts')
    <script src="{{asset('assets/js/permission.js')}}"></script>
@endpush
