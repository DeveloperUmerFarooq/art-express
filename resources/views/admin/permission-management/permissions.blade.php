@extends('layouts.adminLayout.layout')
@section('title')
Role-Management
@endsection

@section('page')
<center>Role Management</center>
@foreach ($roles as $role)
        {{$role->name}}
        {{$role->permissions->pluck('names')}}
@endforeach
@endsection
