@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')

@section('page')

<div class="card shadow-sm mt-2 container" style="height: max-content !important">
    <div class="card-body text-center">
        <h5 class="card-title">No Messages Yet</h5>
        <p class="card-text">It looks like there are no messages sent or recieved!</p>
    </div>
</div>
@endsection
