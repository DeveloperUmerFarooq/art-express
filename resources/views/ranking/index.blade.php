@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')

@section('page')

<div class="card shadow-sm mt-2 container" style="height: max-content !important">
    <div class="card-body text-center">
        <h5 class="card-title">No Ranking Produced!</h5>
        <p class="card-text">It looks like all artists has sales below 10!</p>
    </div>
</div>
@endsection
