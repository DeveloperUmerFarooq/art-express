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
                        <button class="btn btn-primary btn-sm mt-md-3 mt-2 mx-auto">Edit Permissions</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
