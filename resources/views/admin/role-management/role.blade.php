@extends('layouts.adminLayout.layout')

@section('title')
Role Management | Art-Express
@endsection

@section('page')
<div class="container mt-5">
    <div class="row">
        @foreach ($roles as $role)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-auto">
                    <div class="card-header bg-success text-white text-center">
                        <h5 class="mb-0">
                            <i class="fas fa-user-shield me-2"></i>Role: {{ ucfirst($role->name) }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="fw-bold">
                            <i class="fas fa-key me-2 text-info"></i>Permissions:
                        </h6>
                        @if($role->permissions->isEmpty())
                            <p class="text-muted">No permissions assigned.</p>
                        @else
                            <ul class="list-group list-group-flush mb-3">
                                @foreach ($role->permissions as $permission)
                                    <li class="list-group-item">
                                        <i class="fas fa-check-circle text-success me-2"></i>{{ ucfirst($permission->name) }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="text-center">
                            <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#Edit-Permission-Role"
                                onclick="CheckPermissions({{ $role->permissions }}, {{ $role->id }})">
                                <i class="fas fa-edit me-1"></i> Edit Permissions
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('admin.role-management.modals._edit-permissions')
@endsection

@push('scripts')
    <script src="{{ asset('js/permission.js') }}"></script>
@endpush
