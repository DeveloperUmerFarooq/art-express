@if ($user->hasRole('artist'))
<a href="{{route(auth()->user()->getRoleNames()->first().'.profile.view', $user->id)}}" style="text-decoration: none; color:black">
<div class="d-flex align-items-center gap-2">
    <img class="rounded-circle" src="{{asset('storage/users-avatar/'.$user->avatar)}}" alt="" style="height: 40px; width: 40px; object-fit: cover;">
    <div class="d-flex flex-column">
        <b><p class="mb-0 text-start" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            {{$user->name}}
        </p></b>
        <p class="mb-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            <small>{{$user->email}}</small>
        </p>
    </div>
</div>
</a>
@else
<a href="{{route(auth()->user()->getRoleNames()->first().'.profile.details.view', $user->id)}}" style="text-decoration: none; color:black">
    <div class="d-flex align-items-center gap-2">
        <img class="rounded-circle" src="{{asset('storage/users-avatar/'.$user->avatar)}}" alt="" style="height: 40px; width: 40px; object-fit: cover;">
        <div class="d-flex flex-column">
            <b><p class="mb-0 text-start" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                {{$user->name}}
            </p></b>
            <p class="mb-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                <small>{{$user->email}}</small>
            </p>
        </div>
    </div>
    </a>
@endif

